<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori Aset - SIP-ASET</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-admin.css') }}">
</head>
<body class="bg-gray-100 font-inter">
    
    @include('components.sidebar-admin')
    
    <div class="lg:ml-64 min-h-screen">
        <header class="sticky top-0 z-30 bg-white shadow-sm">
            <div class="flex items-center justify-between px-4 py-3 lg:px-6">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <h1 class="text-lg font-semibold text-gray-800">Kelola Kategori Aset</h1>
                </div>
            </div>
        </header>
        
        <main class="p-4 lg:p-6">
            <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                <div class="flex flex-col sm:flex-row gap-4 items-end">
                    <div class="flex-1 w-full">
                        <input type="text" id="searchInput" onkeyup="handleSearch()" placeholder="Cari kategori..." class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500/20 outline-none">
                    </div>
                    <button onclick="openAddCategoryModal()" class="w-full sm:w-auto px-4 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 flex items-center justify-center gap-2">
                        <i class="fas fa-plus"></i> Tambah Kategori
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase">No</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Nama Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Kode</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Deskripsi</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200" id="categoryTableBody"></tbody>
                    </table>
                </div>
                <div class="bg-gray-50 border-t px-6 py-4 flex items-center justify-between">
                    <div class="text-sm text-gray-600">Menampilkan <span id="pageInfo">0</span> dari <span id="totalInfo">0</span> data</div>
                    <div class="flex gap-2" id="paginationControls"></div>
                </div>
            </div>
        </main>
    </div>

    <div id="categoryModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50" onclick="closeCategoryModal()"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4 pointer-events-none">
            <div class="bg-white rounded-2xl shadow-xl max-w-md w-full pointer-events-auto p-6">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-800 mb-4">Tambah Kategori</h3>
                
                <form id="categoryForm" action="" method="POST" class="space-y-4">
                    @csrf
                    <div id="methodField"></div> <input type="hidden" name="id" id="categoryId">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                        <input type="text" name="name" id="categoryName" class="w-full px-4 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500/20 outline-none" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="categoryDescription" rows="3" class="w-full px-4 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500/20 outline-none"></textarea>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="button" onclick="closeCategoryModal()" class="flex-1 px-4 py-2.5 border rounded-lg text-sm">Batal</button>
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    // 1. Data & State
    let categories = @json($categories);
    let itemsPerPage = 5;
    let currentPage = 1;
    let filteredCategories = [...categories];

    // 2. Lifecycle
    document.addEventListener('DOMContentLoaded', function() {
        renderTable();
        initActiveMenu();
    });

    // 3. Sidebar Logic
    function initActiveMenu() {
        const currentPath = window.location.pathname;
        document.querySelectorAll('.submenu a').forEach(link => {
            if (currentPath.includes(link.getAttribute('href'))) {
                const submenu = link.closest('.submenu');
                const btn = submenu.previousElementSibling; // Button toggle
                submenu.classList.add('open');
                btn?.querySelector('.fa-chevron-down')?.classList.add('rotate-180');
                btn?.classList.add('bg-white/10');
            }
        });
    }

    function toggleSubmenu(button) {
        const container = button.closest('.submenu-container');
        const submenu = container.querySelector('.submenu');
        const chevron = button.querySelector('.fa-chevron-down');

        // Accordion effect: tutup yang lain
        document.querySelectorAll('.submenu').forEach(other => {
            if (other !== submenu) {
                other.classList.remove('open');
                other.previousElementSibling.querySelector('.fa-chevron-down')?.classList.remove('rotate-180');
            }
        });

        submenu.classList.toggle('open');
        chevron?.classList.toggle('rotate-180');
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar?.classList.toggle('-translate-x-full');
        overlay?.classList.toggle('hidden');
    }

    // 4. Modal Logic (Fixed with 'name' attributes)
    function openAddCategoryModal() {
        document.getElementById('modalTitle').textContent = 'Tambah Kategori Aset';
        document.getElementById('categoryForm').action = "{{ route('kategori-aset.store') }}";
        document.getElementById('methodField').innerHTML = '';
        document.getElementById('categoryForm').reset();
        document.getElementById('categoryModal').classList.remove('hidden');
    }

    function editCategory(id, name, description) {
        document.getElementById('modalTitle').textContent = 'Edit Kategori Aset';
        document.getElementById('categoryForm').action = `/kategori-aset/${id}`;
        document.getElementById('methodField').innerHTML = '@method("PUT")';
        
        document.getElementById('categoryId').value = id;
        document.getElementById('categoryName').value = name;
        document.getElementById('categoryDescription').value = (description === 'null' || !description) ? '' : description;

        document.getElementById('categoryModal').classList.remove('hidden');
    }

    function closeCategoryModal() {
        document.getElementById('categoryModal').classList.add('hidden');
    }

    // 5. CRUD UI Logic
    function renderTable() {
        const tbody = document.getElementById('categoryTableBody');
        const start = (currentPage - 1) * itemsPerPage;
        const data = filteredCategories.slice(start, start + itemsPerPage);

        if (data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">Data tidak ditemukan</td></tr>';
            return;
        }

        tbody.innerHTML = data.map((item, i) => `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm">${start + i + 1}</td>
                <td class="px-6 py-4 text-sm font-medium">${item.name}</td>
                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">${item.code}</span></td>
                <td class="px-6 py-4 text-sm text-gray-600">${item.description || '-'}</td>
                <td class="px-6 py-4 text-center">
                    <div class="flex justify-center gap-2">
                        <button onclick="editCategory(${item.id}, '${item.name}', '${item.description}')" class="p-2 text-blue-600"><i class="fas fa-edit"></i></button>
                        <form action="/kategori-aset/${item.id}" method="POST" onsubmit="return confirm('Hapus data ini?')" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-red-600"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        `).join('');

        updatePagination();
    }

    function updatePagination() {
        const total = filteredCategories.length;
        document.getElementById('pageInfo').textContent = Math.min(itemsPerPage, total);
        document.getElementById('totalInfo').textContent = total;
        
        let btns = '';
        const totalPages = Math.ceil(total / itemsPerPage);
        for (let i = 1; i <= totalPages; i++) {
            btns += `<button onclick="goToPage(${i})" class="px-3 py-1 rounded text-sm ${i === currentPage ? 'bg-blue-600 text-white' : 'bg-white border'}">${i}</button>`;
        }
        document.getElementById('paginationControls').innerHTML = btns;
    }

    function goToPage(p) { currentPage = p; renderTable(); }

    function handleSearch() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        filteredCategories = categories.filter(c => c.name.toLowerCase().includes(q) || (c.code && c.code.toLowerCase().includes(q)));
        currentPage = 1;
        renderTable();
    }
</script>
</body>
</html>