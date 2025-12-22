<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aset Terpakai - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style-employee.css">
</head>
<body class="bg-gray-100 font-inter flex flex-col min-h-screen">
    
    <!-- Sidebar Overlay (Mobile) -->
    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>
    
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar-transition fixed top-0 left-0 z-50 h-full w-64 bg-gov-primary text-white -translate-x-full lg:translate-x-0">
        <!-- Logo -->
        <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-building-columns text-gov-primary text-lg"></i>
            </div>
            <div class="sidebar-text">
                <h1 class="font-bold text-sm leading-tight">SIP-ASET</h1>
                <p class="text-xs text-white/70">Pendataan Aset</p>
            </div>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="px-3 py-4 space-y-1 overflow-y-auto h-[calc(100vh-180px)]">
            <!-- Dashboard -->
            <a href="dashboard-pegawai.html" class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors">
                <i class="fas fa-chart-pie w-5 text-center"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
            
            <!-- Data Aset (with Submenu) -->
            <div class="submenu-container">
                <button onclick="toggleSubmenu(this)" class="menu-item w-full flex items-center justify-between px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-boxes-stacked w-5 text-center"></i>
                        <span class="sidebar-text">Data Aset</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs sidebar-text transition-transform duration-300"></i>
                </button>
                <div class="submenu pl-8 space-y-1 mt-1">
                    <a href="aset-baru.html" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 text-sm text-white/80 hover:text-white transition-colors">
                        <i class="fas fa-box w-4 text-center text-xs"></i>
                        <span>Aset Baru</span>
                    </a>
                    <a href="aset-terpakai.html" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 text-sm text-white/80 hover:text-white transition-colors">
                        <i class="fas fa-box-open w-4 text-center text-xs"></i>
                        <span>Aset Terpakai</span>
                    </a>
                </div>
            </div>
        </nav>
        
        <!-- User Profile (Bottom) -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10 bg-gov-primary-dark">
            <div class="flex items-center gap-3">
                <div class="sidebar-text flex-1 min-w-0">
                    <p class="text-sm font-medium truncate">Pegawai Dinas</p>
                    <p class="text-xs text-white/60 truncate">pegawai@sipaset.go.id</p>
                </div>
                <button class="sidebar-text p-2 hover:bg-white/10 rounded-lg transition-colors" title="Logout">
                    <i class="fas fa-right-from-bracket text-sm"></i>
                </button>
            </div>
        </div>
    </aside>
    
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
                        <p class="text-xs text-gray-500 hidden sm:block">Daftar aset yang sedang digunakan</p>
                    </div>
                </div>
                
                <!-- Right: Actions -->
                <div class="flex items-center gap-2 sm:gap-4">
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-4 lg:p-6">
            
            <!-- Stats Cards -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
                <!-- Total Aset Terpakai -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base text-gray-500 mb-1">Total Aset Terpakai</p>
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">126</h3>
                            <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-up"></i>
                                <span>8 ditambah bulan ini</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-box-open text-amber-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Aset Kondisi Baik -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base text-gray-500 mb-1">Kondisi Baik</p>
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">110</h3>
                            <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                                <span>87%</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Aset Rusak Ringan -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base text-gray-500 mb-1">Rusak Ringan</p>
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">12</h3>
                            <p class="text-xs text-yellow-600 mt-2 flex items-center gap-1">
                                <span>10%</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Aset Rusak Berat -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base text-gray-500 mb-1">Rusak Berat</p>
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">4</h3>
                            <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                <span>3%</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-times-circle text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Filter & Actions Bar -->
            <section class="bg-white rounded-xl shadow-sm p-4 mb-6">
                <div class="flex flex-col sm:flex-row items-end gap-3 justify-between">
                    <!-- Filter by Kategori -->
                    <div class="w-full sm:w-auto">
                        <select class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            <option value="">Semua Kategori</option>
                            <option value="perangkat-kantor">Perangkat Kantor</option>
                            <option value="komputer">Komputer</option>
                            <option value="jaringan">Jaringan</option>
                        </select>
                    </div>
                    
                    <!-- Search Bar -->
                    <div class="relative w-full sm:w-48">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" placeholder="Cari aset..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                    </div>
                </div>
            </section>
            
            <!-- Table View -->
            <section class="mb-6 bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 bg-gray-50">
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">No</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Aset</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Kategori</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Kondisi</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row 1 -->
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-800">1</td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-800 font-medium">Laptop ASUS VivoBook</td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Komputer</td>
                                <td class="px-3 sm:px-6 py-4 text-sm">
                                    <span class="px-1.5 sm:px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium whitespace-nowrap">Digunakan</span>
                                </td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Meja Kerja A1</td>
                            </tr>
                            
                            <!-- Row 2 -->
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-800">2</td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-800 font-medium">Scanner Canon LiDE</td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Perangkat Kantor</td>
                                <td class="px-3 sm:px-6 py-4 text-sm">
                                    <span class="px-1.5 sm:px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium whitespace-nowrap">Digunakan</span>
                                </td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Ruang Bersama</td>
                            </tr>
                            
                            <!-- Row 3 -->
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-800">3</td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-800 font-medium">Proyektor Epson EB</td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Perangkat Kantor</td>
                                <td class="px-3 sm:px-6 py-4 text-sm">
                                    <span class="px-1.5 sm:px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium inline-block">
                                        <span class="hidden sm:inline">Rusak Ringan</span>
                                        <span class="sm:hidden">R. Ringan</span>
                                    </span>
                                </td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Ruang Rapat</td>
                            </tr>
                            
                            <!-- Row 4 -->
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-800">4</td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-800 font-medium">Kursi Kantor Ergonomis</td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Furniture</td>
                                <td class="px-3 sm:px-6 py-4 text-sm">
                                    <span class="px-1.5 sm:px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium inline-block">
                                        <span class="hidden sm:inline">Rusak Berat</span>
                                        <span class="sm:hidden">R. Berat</span>
                                    </span>
                                </td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Meja Kerja</td>
                            </tr>
                            
                            <!-- Row 5 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-800">5</td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-800 font-medium">AC Split LG 2 PK</td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Perangkat Kantor</td>
                                <td class="px-3 sm:px-6 py-4 text-sm">
                                    <span class="px-1.5 sm:px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium whitespace-nowrap">Digunakan</span>
                                </td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Ruang Kepala</td>
                            </tr>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Ruang Kepala</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            
            <!-- Pagination -->
            <section class="flex items-center justify-between px-4 py-4 bg-white rounded-xl shadow-sm mb-6">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold">1</span> hingga <span class="font-semibold">5</span> dari <span class="font-semibold">126</span> aset
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
