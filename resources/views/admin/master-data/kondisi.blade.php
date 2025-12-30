<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kondisi Aset - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
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
                        <h1 class="text-lg font-semibold text-gray-800">Kelola Kondisi Aset</h1>
                        <p class="text-xs text-gray-500 hidden sm:block">Atur dan kelola daftar kondisi aset</p>
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
                        <input type="text" id="searchInput" placeholder="Cari kondisi aset..." class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                    </div>
                    <button onclick="openAddConditionModal()" class="px-4 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors flex items-center gap-2 whitespace-nowrap">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Kondisi</span>
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
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Kondisi</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                       <tbody class="divide-y divide-gray-200">
                            @forelse($conditions as $index => $condition)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-800">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $condition->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $condition->description ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        <div class="flex items-center justify-center gap-2">
                                    <button data-id="{{ $condition->id }}" data-name="{{ $condition->name }}" data-description="{{ $condition->description }}"
                                    onclick="openEditModal(this)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                    </button>
                        <form action="{{ route('admin.kondisi-aset.destroy', $condition->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </td>
@empty
<tr>
    <td colspan="4" class="text-center text-gray-500 py-4">Belum ada data kondisi aset</td>
</tr>
@endforelse
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
                    <p class="text-gray-500 text-sm">Belum ada data kondisi aset</p>
                </div>
            </div>

        </main>
    </div>

    <!-- Add/Edit Condition Modal -->
    <div id="conditionModal" class="fixed inset-0 z-50 hidden p-4">
        <!-- Desktop Backdrop & Modal -->
        <div class="hidden lg:flex items-center justify-center inset-0 absolute">
            <div id="desktopBackdrop" class="absolute inset-0 bg-black/50" onclick="closeConditionModal()"></div>
            <div id="desktopModal" class="relative bg-white rounded-2xl shadow-xl max-w-md w-full">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200">
                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah Kondisi Aset</h3>
                </div>

                <!-- Form -->
                <form id="conditionForm" action="{{ route('admin.kondisi-aset.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                <input type="hidden" name="id" id="conditionId">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kondisi</label>
                    <input type="text" name="name" id="conditionName" class="w-full ..." required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="conditionDescription" rows="3" class="w-full ..."></textarea>
                </div>
                    <div class="flex gap-3 pt-4 border-t border-gray-200">
                        <button type="button" onclick="closeConditionModal()" class="flex-1 px-4 py-2.5 ...">Batal</button>
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 text-white ...">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Mobile Bottom Sheet -->
        <div id="mobileBackdrop" class="lg:hidden fixed inset-0 bg-black/50 hidden" onclick="closeConditionModal()"></div>
        <div id="mobileModal" class="lg:hidden hidden fixed bottom-0 left-0 right-0 bg-white rounded-t-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
            <!-- Handle Bar -->
            <div class="flex justify-center pt-3 pb-2">
                <div class="w-12 h-1 bg-gray-300 rounded-full"></div>
            </div>
            
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 id="mobileTitleCondition" class="text-lg font-semibold text-gray-800">Tambah Kondisi Aset</h3>
            </div>

            <!-- Form -->
            <form id="conditionFormMobile" onsubmit="handleConditionSubmit(event)" class="p-6 space-y-4 pb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kondisi</label>
                    <input type="text" id="conditionNameMobile" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Contoh: Baik, Rusak Ringan" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea id="conditionDescriptionMobile" rows="3" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Jelaskan kondisi ini (opsional)"></textarea>
                </div>

                <!-- Actions -->
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeConditionModal()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
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
        // Data kondisi aset
        let conditions = [
            { id: 1, name: 'Baik', description: 'Aset dalam kondisi baik dan dapat digunakan' },
            { id: 2, name: 'Rusak Ringan', description: 'Aset masih dapat digunakan dengan perbaikan kecil' },
            { id: 3, name: 'Rusak Berat', description: 'Aset tidak dapat digunakan dan perlu perbaikan besar' },
            { id: 4, name: 'Tidak Layak Pakai', description: 'Aset sudah tidak layak digunakan lagi' }
        ];

        let editingId = null;
        let pendingDeleteId = null;

        // Render table
        function renderConditionTable() {
            const tbody = document.getElementById('conditionTableBody');
            const emptyState = document.getElementById('emptyState');
            
            if (conditions.length === 0) {
                tbody.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }

            emptyState.classList.add('hidden');
            tbody.innerHTML = conditions.map((condition, index) => `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-800">${index + 1}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800">${condition.name}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">${condition.description || '-'}</td>
                    <td class="px-6 py-4 text-sm text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="editCondition(${condition.id})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteCondition(${condition.id})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function openAddConditionModal() {
            editingId = null;
            const title = 'Tambah Kondisi Aset';
            
            // Update desktop
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('conditionForm').reset();
            
            // Update mobile
            document.getElementById('mobileTitleCondition').textContent = title;
            document.getElementById('conditionFormMobile').reset();
            
            // Show modal container
            document.getElementById('conditionModal').classList.remove('hidden');
            
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

        function closeConditionModal() {
            const modal = document.getElementById('conditionModal');
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

        function openEditModal(button) {
            const id = button.dataset.id;
            const name = button.dataset.name;
            const description = button.dataset.description;

            editingId = id;
            const title = 'Edit Kondisi Aset';
            
            // Update desktop
            document.getElementById('modalTitle').textContent = 'Edit Kondisi Aset';
            document.getElementById('conditionId').value = id;
            document.getElementById('conditionName').value = name;
            document.getElementById('conditionDescription').value = description || '';

            document.getElementById('conditionModal').classList.remove('hidden');
            
            // Update mobile
            document.getElementById('mobileTitleCondition').textContent = title;
            document.getElementById('conditionNameMobile').value = condition.name;
            document.getElementById('conditionDescriptionMobile').value = condition.description || '';
            
            // Show modal container
            document.getElementById('conditionModal').classList.remove('hidden');
            
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

        function handleConditionSubmit(event) {
            event.preventDefault();

            // Get value dari form yang aktif (desktop atau mobile)
            const isMobile = window.innerWidth < 1024;
            let name, description;
            
            if (isMobile) {
                name = document.getElementById('conditionNameMobile').value.trim();
                description = document.getElementById('conditionDescriptionMobile').value.trim();
            } else {
                name = document.getElementById('conditionName').value.trim();
                description = document.getElementById('conditionDescription').value.trim();
            }

            if (!name) {
                alert('Nama kondisi tidak boleh kosong!');
                return;
            }

            if (editingId) {
                // Update existing
                const condition = conditions.find(c => c.id === editingId);
                if (condition) {
                    condition.name = name;
                    condition.description = description;
                }
            } else {
                // Add new
                const newId = Math.max(...conditions.map(c => c.id), 0) + 1;
                conditions.push({
                    id: newId,
                    name,
                    description
                });
            }

            renderConditionTableWithPagination();
            closeConditionModal();
            showSuccessNotification(editingId ? 'Kondisi berhasil diperbarui' : 'Kondisi berhasil ditambahkan');
        }

        function deleteCondition(id) {
            const condition = conditions.find(c => c.id === id);
            if (!condition) return;
            
            pendingDeleteId = id;
            document.getElementById('deleteDataName').textContent = `"${condition.name}"`;
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function closeDeleteConfirm() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
            pendingDeleteId = null;
        }

        function confirmDelete() {
            if (pendingDeleteId === null) return;
            
            conditions = conditions.filter(c => c.id !== pendingDeleteId);
            filteredConditions = filteredConditions.filter(c => c.id !== pendingDeleteId);
            currentPage = Math.max(1, Math.ceil(filteredConditions.length / itemsPerPage) > 0 ? currentPage : 1);
            renderConditionTableWithPagination();
            closeDeleteConfirm();
            showSuccessNotification('Kondisi berhasil dihapus');
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
        let filteredConditions = [...conditions];

        function renderPagination() {
            const totalPages = Math.ceil(filteredConditions.length / itemsPerPage);
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
            const totalPages = Math.ceil(filteredConditions.length / itemsPerPage);
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            renderConditionTableWithPagination();
        }

        function renderConditionTableWithPagination() {
            const tbody = document.getElementById('conditionTableBody');
            const emptyState = document.getElementById('emptyState');
            
            if (filteredConditions.length === 0) {
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
            const pageData = filteredConditions.slice(startIdx, endIdx);
            
            tbody.innerHTML = pageData.map((condition, index) => `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-800">${startIdx + index + 1}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800">${condition.name}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">${condition.description || '-'}</td>
                    <td class="px-6 py-4 text-sm text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="editCondition(${condition.id})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteCondition(${condition.id})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');

            const totalPages = Math.ceil(filteredConditions.length / itemsPerPage);
            document.getElementById('pageInfo').textContent = pageData.length;
            document.getElementById('totalInfo').textContent = filteredConditions.length;
            
            renderPagination();
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', (e) => {
            const query = e.target.value.toLowerCase();
            filteredConditions = conditions.filter(c => 
                c.name.toLowerCase().includes(query) ||
                c.description.toLowerCase().includes(query)
            );
            currentPage = 1;
            renderConditionTableWithPagination();
        });

        // Initial render
        filteredConditions = [...conditions];
        renderConditionTableWithPagination();
    </script>
</body>
</html>
