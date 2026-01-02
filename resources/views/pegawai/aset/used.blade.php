<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aset Terpakai - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-employee.css') }}">
</head>
<body class="bg-gray-100 font-inter flex flex-col min-h-screen">
    
    @include('components.sidebar-employee')
    
    <!-- Main Content Wrapper -->
    <div class="lg:ml-64 flex flex-col flex-1">
        
        <!-- Topbar -->
        <header class="sticky top-0 z-30 bg-white shadow-sm">
            <div class="flex items-center justify-between px-4 py-3 lg:px-6">
                <!-- Left: Hamburger + Title -->
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <div>
                        <h1 class="text-lg font-semibold text-gray-800">Aset Terpakai</h1>
                        <p class="text-xs text-gray-500 hidden sm:block">Daftar Aset Terpakai</p>
                    </div>
                </div>
                
                <!-- Right: Actions -->
                <div class="flex items-center gap-2 sm:gap-4">
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <main class="p-4 lg:p-6">

    <section class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-5 mb-6">

        <!-- Total Terpakai -->
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Terpakai</p>
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-800">
                        {{ number_format($totalTerpakai) }}
                    </h3>
                    <p class="text-xs text-blue-600 mt-2 flex items-center gap-1">
                        <i class="fas fa-arrow-up"></i>
                        <span>
                            {{ $terpakaiBulanIni > 0 ? $terpakaiBulanIni.' bulan ini' : 'Tidak ada bulan ini' }}
                        </span>
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-box-open text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Kondisi Baik -->
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Kondisi Baik</p>
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-800">
                        {{ number_format($kondisiBaik) }}
                    </h3>
                    <p class="text-xs text-green-600 mt-2">
                        {{ $persenBaik }}% dari total
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-circle-check text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Rusak Ringan -->
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Rusak Ringan</p>
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-800">
                        {{ number_format($kondisiRusakRingan) }}
                    </h3>
                    <p class="text-xs text-amber-600 mt-2">
                        {{ $persenRusakRingan }}% dari total
                    </p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-triangle-exclamation text-amber-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Rusak Berat -->
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Rusak Berat</p>
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-800">
                        {{ number_format($kondisiRusakBerat) }}
                    </h3>
                    <p class="text-xs text-red-600 mt-2">
                        {{ $persenRusakBerat }}% dari total
                    </p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-circle-xmark text-red-600 text-xl"></i>
                </div>
            </div>
        </div>

    </section>
            
            <!-- Filter & Actions Bar -->
            <!-- Filter & Actions Bar -->
<section class="bg-white rounded-xl shadow-sm p-4 mb-6">
    <form method="GET" action="{{ route('manajemen-aset.index') }}"
          class="flex flex-col sm:flex-row items-end gap-3 justify-between">

        <!-- Filter by Kategori -->
        <div class="w-full sm:w-auto">
            <select name="category"
                class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-600
                       focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">

                <option value="">Semua Kategori</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Search Bar -->
        <div class="relative w-full sm:w-48">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari aset..."
                   class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
        </div>

        <!-- Submit otomatis -->
        <button class="hidden">Filter</button>
    </form>
</section>
                </div>
            </section>
            
            <!-- Table View -->
            <section class="mb-4 bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="max-w-6xl mx-auto px-4">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="px-3 py-2 text-left font-semibold text-gray-600 w-10">No</th>
                        <th class="px-3 py-2 text-left font-semibold text-gray-600">Nama Aset</th>
                        <th class="px-3 py-2 text-left font-semibold text-gray-600">Kategori</th>
                        <th class="px-3 py-2 text-left font-semibold text-gray-600">Kondisi</th>
                        <th class="px-3 py-2 text-left font-semibold text-gray-600">Lokasi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($asets as $index => $aset)
                        <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                            <td class="px-3 py-2 text-gray-700">
                                {{ $asets->firstItem() + $index }}
                            </td>

                            <td class="px-3 py-2 text-gray-800 font-medium">
                                {{ $aset->nama_aset }}
                            </td>

                            <td class="px-3 py-2 text-gray-600">
                                {{ $aset->kategori->name ?? '-' }}
                            </td>

                            <td class="px-3 py-2">
                                @php
                                    $badge = match ($aset->kondisi->code ?? '') {
                                        'baik'   => 'bg-green-100 text-green-700',
                                        'cukup'  => 'bg-yellow-100 text-yellow-700',
                                        'rusak'  => 'bg-red-100 text-red-700',
                                        default  => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp

                                <span class="px-2 py-0.5 rounded text-xs font-medium {{ $badge }}">
                                    {{ $aset->kondisi->name ?? '-' }}
                                </span>
                            </td>

                            <td class="px-3 py-2 text-gray-600">
                                {{ $aset->lokasi ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-6 text-center text-gray-500">
                                Tidak ada data aset
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

</div>
            
            <!-- Pagination -->
            <section class="flex items-center justify-between px-4 py-4 bg-white rounded-xl shadow-sm mb-6">
                <<div class="text-sm text-gray-600">
    Menampilkan
    <span class="font-semibold">{{ $asets->firstItem() }}</span>
    hingga
    <span class="font-semibold">{{ $asets->lastItem() }}</span>
    dari
    <span class="font-semibold">{{ $asets->total() }}</span>
    aset
</div>

                <div class="flex items-center gap-2">
                    <button class="px-3 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="flex gap-1">
                        <button class="px-3 py-2 bg-blue-600 text-white rounded-lg font-medium">1</button>
                        <button class="px-3 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">2</button>
                        <button class="px-3 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">3</button>
                        <span class="px-3 py-2 text-gray-600">...</span>
                        <button class="px-3 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">26</button>
                    </div>
                    <button class="px-3 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </section>
            
        </main>
        
    </div>
    
    <!-- JavaScript -->
    <script>
        // Toggle Submenu
        function toggleSubmenu(button) {
            const container = button.closest('.submenu-container');
            const submenu = container.querySelector('.submenu');
            const chevron = button.querySelector('.fa-chevron-down');
            const menuText = button.querySelector('.sidebar-text');
            
            submenu.classList.toggle('open');
            chevron.classList.toggle('rotate-180');
            
            // Save state to sessionStorage
            if (menuText && menuText.textContent === 'Data Aset') {
                sessionStorage.setItem('dataAsetSubmenuOpen', submenu.classList.contains('open'));
            }
        }

        // Manage submenu state based on page location
        window.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname;
            const isDataAsetPage = currentPage.includes('aset-baru') || currentPage.includes('aset-terpakai');
            
            const containers = document.querySelectorAll('.submenu-container');
            containers.forEach(container => {
                const button = container.querySelector('button');
                const menuText = button.querySelector('.sidebar-text');
                const submenu = container.querySelector('.submenu');
                const chevron = button.querySelector('.fa-chevron-down');
                
                // Mark submenu items as active
                if (menuText && menuText.textContent === 'Data Aset') {
                    const submenuLinks = submenu.querySelectorAll('a');
                    submenuLinks.forEach(link => {
                        const linkText = link.textContent.trim();
                        if ((currentPage.includes('aset-baru') && linkText === 'Aset Baru') ||
                            (currentPage.includes('aset-terpakai') && linkText === 'Aset Terpakai')) {
                            link.classList.add('active');
                        } else {
                            link.classList.remove('active');
                        }
                    });
                }
                
                // Only auto-open submenu on Data Aset pages, not on Dashboard
                if (isDataAsetPage && menuText && menuText.textContent === 'Data Aset') {
                    button.classList.add('active');
                    
                    // Check if user has set a preference
                    const savedState = sessionStorage.getItem('dataAsetSubmenuOpen');
                    
                    // If no saved state, open by default. If saved state exists, respect it.
                    if (savedState === null || savedState === 'true') {
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
                    } else if (savedState === 'false') {
                        // User manually closed it - keep it closed, remove classes
                        submenu.classList.remove('open');
                        chevron.classList.remove('rotate-180');
                    }
                }
            });
        });
        
        // Toggle Sidebar (Mobile)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth < 1024 && !sidebar.classList.contains('-translate-x-full')) {
                if (!sidebar.contains(event.target) && !event.target.closest('[onclick="toggleSidebar()"]')) {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                }
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });
        

    </script>        

    </script>
    
</body>
</html>
