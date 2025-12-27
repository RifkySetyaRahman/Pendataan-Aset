<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori Aset - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style-admin.css">
</head>
<body class="bg-gray-100 font-inter">
    
    @include('components.sidebar-admin')
    
    <!-- Main Content Wrapper -->
    <div class="lg:ml-64 min-h-screen">
        
        <!-- Topbar -->
        <header class="sticky top-0 z-30 bg-white shadow-sm">
            <div class="flex items-center justify-between px-4 py-3 lg:px-6">
                <!-- Left: Hamburger + Title -->
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <div>
                        <h1 class="text-lg font-semibold text-gray-800">Kelola Kategori Aset</h1>
                        <p class="text-xs text-gray-500 hidden sm:block">Atur dan kelola daftar kategori aset</p>
                    </div>
                </div>
                
                <!-- Right: Actions -->
                <div class="flex items-center gap-2 sm:gap-4">
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <main class="p-4 lg:p-6">
            
            <!-- Search & Filter -->
            <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                <div class="flex flex-col sm:flex-row gap-4 items-end">
                    <div class="flex-1">
                        <input type="text" id="searchInput" placeholder="Cari kategori aset..." class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                    </div>
                    <button onclick="openAddCategoryModal()" class="px-4 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors flex items-center gap-2 whitespace-nowrap">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Kategori</span>
                    </button>
                </div>
            </div>

            <!-- Data Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kode</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200" id="categoryTableBody">
                            <!-- Data akan di-load dari array -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="bg-gray-50 border-t border-gray-200 px-6 py-4 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Menampilkan <span id="pageInfo">0</span> dari <span id="totalInfo">0</span> data
                    </div>
                    <div class="flex gap-2" id="paginationControls"></div>
                </div>
                
                <!-- Empty State -->
                <div id="emptyState" class="p-8 text-center hidden">
                    <div class="mb-4">
                        <i class="fas fa-inbox text-4xl text-gray-300"></i>
                    </div>
                    <p class="text-gray-500 text-sm">Belum ada data kategori aset</p>
                </div>
            </div>

        </main>
    </div>

    <!-- Add/Edit Category Modal -->
    <div id="categoryModal" class="fixed inset-0 z-50 hidden p-4">
        <!-- Desktop Backdrop & Modal -->
        <div class="hidden lg:flex items-center justify-center inset-0 absolute">
            <div id="desktopBackdrop" class="absolute inset-0 bg-black/50" onclick="closeCategoryModal()"></div>
            <div id="desktopModal" class="relative bg-white rounded-2xl shadow-xl max-w-md w-full">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200">
                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah Kategori Aset</h3>
                </div>

                <!-- Form -->
                <form id="categoryForm" onsubmit="handleCategorySubmit(event)" class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                        <input type="text" id="categoryName" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Contoh: Komputer, Kendaraan" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Kategori</label>
                        <input type="text" id="categoryCode" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Contoh: KP, KD" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="categoryDescription" rows="3" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Jelaskan kategori ini (opsional)"></textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3 pt-4 border-t border-gray-200">
                        <button type="button" onclick="closeCategoryModal()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Mobile Bottom Sheet -->
        <div id="mobileBackdrop" class="lg:hidden fixed inset-0 bg-black/50 hidden" onclick="closeCategoryModal()"></div>
        <div id="mobileModal" class="lg:hidden hidden fixed bottom-0 left-0 right-0 bg-white rounded-t-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
            <!-- Handle Bar -->
            <div class="flex justify-center pt-3 pb-2">
                <div class="w-12 h-1 bg-gray-300 rounded-full"></div>
            </div>
            
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 id="mobileTitleCategory" class="text-lg font-semibold text-gray-800">Tambah Kategori Aset</h3>
            </div>

            <!-- Form -->
            <form id="categoryFormMobile" onsubmit="handleCategorySubmit(event)" class="p-6 space-y-4 pb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" id="categoryNameMobile" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Contoh: Komputer, Kendaraan" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Kategori</label>
                    <input type="text" id="categoryCodeMobile" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Contoh: KP, KD" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea id="categoryDescriptionMobile" rows="3" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Jelaskan kategori ini (opsional)"></textarea>
                </div>

                <!-- Actions -->
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeCategoryModal()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 z-[9999] hidden p-4">
        <!-- Backdrop -->
        <div id="deleteConfirmBackdrop" class="fixed inset-0 bg-black/50" onclick="closeDeleteConfirm()"></div>
        
        <!-- Modal -->
        <div class="fixed inset-0 flex items-center justify-center pointer-events-none">
            <div id="deleteConfirmContent" class="relative bg-white rounded-2xl shadow-2xl max-w-sm w-full pointer-events-auto transform transition-all">
                <!-- Icon -->
                <div class="pt-6 flex justify-center">
                    <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Hapus Data</h3>
                    <p class="text-sm text-gray-600 mb-6">
                        Apakah Anda yakin ingin menghapus <span id="deleteDataName" class="font-medium text-gray-800"></span>? 
                        <br>Tindakan ini tidak dapat dibatalkan.
                    </p>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <button onclick="closeDeleteConfirm()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button onclick="confirmDelete()" class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-trash text-sm"></i>
                            <span>Hapus</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data kategori aset
        let categories = [
            { id: 1, name: 'Komputer', code: 'KP', description: 'Perangkat komputer dan hardware' },
            { id: 2, name: 'Kendaraan', code: 'KD', description: 'Kendaraan operasional dan dinas' },
            { id: 3, name: 'Perabotan', code: 'PR', description: 'Furnitur dan perabotan kantor' },
            { id: 4, name: 'Elektronik', code: 'EL', description: 'Perangkat elektronik lainnya' },
            { id: 5, name: 'Jaringan', code: 'JR', description: 'Perangkat jaringan dan telekomunikasi' }
        ];

        let editingId = null;
        let pendingDeleteId = null;

        // Render table
        function renderCategoryTable() {
            const tbody = document.getElementById('categoryTableBody');
            const emptyState = document.getElementById('emptyState');
            
            if (categories.length === 0) {
                tbody.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }

            emptyState.classList.add('hidden');
            tbody.innerHTML = categories.map((category, index) => `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-800">${index + 1}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800">${category.name}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs font-medium">${category.code}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">${category.description || '-'}</td>
                    <td class="px-6 py-4 text-sm text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="editCategory(${category.id})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteCategory(${category.id})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function openAddCategoryModal() {
            editingId = null;
            const title = 'Tambah Kategori Aset';
            
            // Update desktop
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('categoryForm').reset();
            
            // Update mobile
            document.getElementById('mobileTitleCategory').textContent = title;
            document.getElementById('categoryFormMobile').reset();
            
            // Show modal container
            document.getElementById('categoryModal').classList.remove('hidden');
            
            // Show appropriate inner modal
            const isMobile = window.innerWidth < 1024;
            if (isMobile) {
                document.getElementById('mobileBackdrop').classList.remove('hidden');
                document.getElementById('mobileModal').classList.remove('hidden');
                document.getElementById('mobileModal').classList.add('modal-sheet-mobile');
            } else {
                document.getElementById('desktopModal').parentElement.classList.remove('hidden');
            }
        }

        function closeCategoryModal() {
            const modal = document.getElementById('categoryModal');
            const mobileModal = document.getElementById('mobileModal');
            const mobileBackdrop = document.getElementById('mobileBackdrop');
            
            const isMobile = window.innerWidth < 1024;
            
            if (isMobile && !mobileModal.classList.contains('hidden')) {
                // Mobile animation
                mobileModal.classList.remove('modal-sheet-mobile');
                mobileModal.classList.add('modal-sheet-mobile', 'hide');
                mobileBackdrop.classList.add('modal-backdrop-mobile', 'hide');
                
                setTimeout(() => {
                    mobileModal.classList.add('hidden');
                    mobileModal.classList.remove('modal-sheet-mobile', 'hide');
                    mobileBackdrop.classList.add('hidden');
                    mobileBackdrop.classList.remove('modal-backdrop-mobile', 'hide');
                    modal.classList.add('hidden');
                    editingId = null;
                }, 300);
            } else {
                // Desktop: close immediately
                modal.classList.add('hidden');
                editingId = null;
            }
        }

        function editCategory(id) {
            const category = categories.find(c => c.id === id);
            if (!category) return;

            editingId = id;
            const title = 'Edit Kategori Aset';
            
            // Update desktop
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('categoryName').value = category.name;
            document.getElementById('categoryCode').value = category.code;
            document.getElementById('categoryDescription').value = category.description || '';
            
            // Update mobile
            document.getElementById('mobileTitleCategory').textContent = title;
            document.getElementById('categoryNameMobile').value = category.name;
            document.getElementById('categoryCodeMobile').value = category.code;
            document.getElementById('categoryDescriptionMobile').value = category.description || '';
            
            // Show modal container
            document.getElementById('categoryModal').classList.remove('hidden');
            
            // Show appropriate inner modal
            const isMobile = window.innerWidth < 1024;
            if (isMobile) {
                document.getElementById('mobileBackdrop').classList.remove('hidden');
                document.getElementById('mobileModal').classList.remove('hidden');
                document.getElementById('mobileModal').classList.add('modal-sheet-mobile');
            } else {
                document.getElementById('desktopModal').parentElement.classList.remove('hidden');
            }
        }
        function handleCategorySubmit(event) {
            event.preventDefault();

            // Get value dari form yang aktif (desktop atau mobile)
            const isMobile = window.innerWidth < 1024;
            let name, code, description;
            
            if (isMobile) {
                name = document.getElementById('categoryNameMobile').value.trim();
                code = document.getElementById('categoryCodeMobile').value.trim().toUpperCase();
                description = document.getElementById('categoryDescriptionMobile').value.trim();
            } else {
                name = document.getElementById('categoryName').value.trim();
                code = document.getElementById('categoryCode').value.trim().toUpperCase();
                description = document.getElementById('categoryDescription').value.trim();
            }

            if (!name || !code) {
                alert('Nama kategori dan kode tidak boleh kosong!');
                return;
            }

            if (editingId) {
                // Update existing
                const category = categories.find(c => c.id === editingId);
                if (category) {
                    category.name = name;
                    category.code = code;
                    category.description = description;
                }
            } else {
                // Add new
                const newId = Math.max(...categories.map(c => c.id), 0) + 1;
                categories.push({
                    id: newId,
                    name,
                    code,
                    description
                });
            }

            renderCategoryTableWithPagination();
            closeCategoryModal();
            showSuccessNotification(editingId ? 'Kategori berhasil diperbarui' : 'Kategori berhasil ditambahkan');
        }

        function deleteCategory(id) {
            const category = categories.find(c => c.id === id);
            if (!category) return;
            
            pendingDeleteId = id;
            document.getElementById('deleteDataName').textContent = `"${category.name}"`;
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function closeDeleteConfirm() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
            pendingDeleteId = null;
        }

        function confirmDelete() {
            if (pendingDeleteId === null) return;
            
            categories = categories.filter(c => c.id !== pendingDeleteId);
            filteredCategories = filteredCategories.filter(c => c.id !== pendingDeleteId);
            currentPage = Math.max(1, Math.ceil(filteredCategories.length / itemsPerPage) > 0 ? currentPage : 1);
            renderCategoryTableWithPagination();
            closeDeleteConfirm();
            showSuccessNotification('Kategori berhasil dihapus');
        }

        function showSuccessNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 z-[9999] bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 animate-in';
            notification.innerHTML = `
                <i class="fas fa-check-circle"></i>
                <span>${message}</span>
            `;
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function toggleSubmenu(button) {
            const container = button.closest('.submenu-container');
            const submenu = container.querySelector('.submenu');
            const chevron = button.querySelector('.fa-chevron-down');
            submenu.classList.toggle('open');
            chevron.classList.toggle('rotate-180');
        }

        // Manage submenu state based on page location
        window.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname;
            const isMasterDataPage = currentPage.includes('form-kategori-aset') || currentPage.includes('form-kondisi-aset');
            const isDataAsetPage = currentPage.includes('aset-baru') || currentPage.includes('aset-terpakai');
            
            const containers = document.querySelectorAll('.submenu-container');
            containers.forEach(container => {
                const button = container.querySelector('button');
                const menuText = button.querySelector('.sidebar-text');
                const submenu = container.querySelector('.submenu');
                const chevron = button.querySelector('.fa-chevron-down');
                
                // Open appropriate submenu without animation and add active class
                if (isMasterDataPage && menuText && menuText.textContent === 'Master Data') {
                    button.classList.add('active');
                    submenu.classList.add('no-transition');
                    chevron.classList.add('no-transition');
                    // Ensure it has open class
                    if (!submenu.classList.contains('open')) {
                        submenu.classList.add('open');
                    }
                    // Ensure chevron is rotated
                    if (!chevron.classList.contains('rotate-180')) {
                        chevron.classList.add('rotate-180');
                    }
                    // Remove no-transition after animation would have completed
                    setTimeout(() => {
                        submenu.classList.remove('no-transition');
                        chevron.classList.remove('no-transition');
                    }, 50);
                } else if (isDataAsetPage && menuText && menuText.textContent === 'Data Aset') {
                    button.classList.add('active');
                    submenu.classList.add('no-transition');
                    chevron.classList.add('no-transition');
                    // Ensure it has open class
                    if (!submenu.classList.contains('open')) {
                        submenu.classList.add('open');
                    }
                    // Ensure chevron is rotated
                    if (!chevron.classList.contains('rotate-180')) {
                        chevron.classList.add('rotate-180');
                    }
                    // Remove no-transition after animation would have completed
                    setTimeout(() => {
                        submenu.classList.remove('no-transition');
                        chevron.classList.remove('no-transition');
                    }, 50);
                } else {
                    // Close other submenus
                    button.classList.remove('active');
                    if (submenu.classList.contains('open')) {
                        submenu.classList.remove('open');
                    }
                    if (chevron.classList.contains('rotate-180')) {
                        chevron.classList.remove('rotate-180');
                    }
                }
            });
        });

        // Handle navigation to close submenu when leaving Master Data or Data Aset
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a[href]');
            if (!link) return;
            
            const href = link.getAttribute('href');
            const isMasterDataPage = window.location.pathname.includes('form-kategori-aset') || window.location.pathname.includes('form-kondisi-aset');
            const isDataAsetPage = window.location.pathname.includes('aset-baru') || window.location.pathname.includes('aset-terpakai');
            
            // Check if navigating away from Master Data or Data Aset
            const isNavigatingAwayFromMasterData = isMasterDataPage && !href.includes('form-kategori-aset') && !href.includes('form-kondisi-aset');
            const isNavigatingAwayFromDataAset = isDataAsetPage && !href.includes('aset-baru') && !href.includes('aset-terpakai');
            
            // Store intent to close submenu if navigating away
            if (isNavigatingAwayFromMasterData) {
                sessionStorage.setItem('closeMasterDataSubmenu', 'true');
            }
            if (isNavigatingAwayFromDataAset) {
                sessionStorage.setItem('closeDataAsetSubmenu', 'true');
            }
        });

        // Pagination
        const itemsPerPage = 5;
        let currentPage = 1;
        let filteredCategories = [...categories];

        function renderPagination() {
            const totalPages = Math.ceil(filteredCategories.length / itemsPerPage);
            const paginationControls = document.getElementById('paginationControls');
            paginationControls.innerHTML = '';

            // Previous button
            const prevBtn = document.createElement('button');
            prevBtn.className = `px-3 py-1.5 rounded border ${currentPage === 1 ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50'} text-sm font-medium transition-colors`;
            prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
            prevBtn.onclick = () => currentPage > 1 && goToPage(currentPage - 1);
            prevBtn.disabled = currentPage === 1;
            paginationControls.appendChild(prevBtn);

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.className = `px-3 py-1.5 rounded text-sm font-medium transition-colors ${
                    i === currentPage 
                        ? 'bg-blue-600 text-white' 
                        : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'
                }`;
                pageBtn.textContent = i;
                pageBtn.onclick = () => goToPage(i);
                paginationControls.appendChild(pageBtn);
            }

            // Next button
            const nextBtn = document.createElement('button');
            nextBtn.className = `px-3 py-1.5 rounded border ${currentPage === totalPages ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50'} text-sm font-medium transition-colors`;
            nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
            nextBtn.onclick = () => currentPage < totalPages && goToPage(currentPage + 1);
            nextBtn.disabled = currentPage === totalPages;
            paginationControls.appendChild(nextBtn);
        }

        function goToPage(page) {
            const totalPages = Math.ceil(filteredCategories.length / itemsPerPage);
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            renderCategoryTableWithPagination();
        }

        function renderCategoryTableWithPagination() {
            const tbody = document.getElementById('categoryTableBody');
            const emptyState = document.getElementById('emptyState');
            
            if (filteredCategories.length === 0) {
                tbody.innerHTML = '';
                emptyState.classList.remove('hidden');
                document.getElementById('paginationControls').innerHTML = '';
                document.getElementById('pageInfo').textContent = '0';
                document.getElementById('totalInfo').textContent = '0';
                return;
            }

            emptyState.classList.add('hidden');
            
            const startIdx = (currentPage - 1) * itemsPerPage;
            const endIdx = startIdx + itemsPerPage;
            const pageData = filteredCategories.slice(startIdx, endIdx);
            
            tbody.innerHTML = pageData.map((category, index) => `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-800">${startIdx + index + 1}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800">${category.name}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs font-medium">${category.code}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">${category.description || '-'}</td>
                    <td class="px-6 py-4 text-sm text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="editCategory(${category.id})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteCategory(${category.id})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');

            const totalPages = Math.ceil(filteredCategories.length / itemsPerPage);
            document.getElementById('pageInfo').textContent = pageData.length;
            document.getElementById('totalInfo').textContent = filteredCategories.length;
            
            renderPagination();
        }

        // Initial render
        filteredCategories = [...categories];
        renderCategoryTableWithPagination();
    </script>
</body>
</html>
