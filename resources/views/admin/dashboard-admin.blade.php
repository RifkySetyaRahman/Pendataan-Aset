<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style-admin.css">
    <script>
        // Apply dark mode immediately before page renders
        (function() {
            const darkModePreference = localStorage.getItem('darkMode');
            if (darkModePreference === 'enabled') {
                document.documentElement.classList.add('dark-mode');
                // Schedule to add class to body as soon as it's available
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', function() {
                        document.body.classList.add('dark-mode');
                    });
                } else {
                    document.body.classList.add('dark-mode');
                }
            }
        })();
    </script>
</head>
<body class="bg-gray-100 font-inter">
    
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
            <a href="#" class="menu-item active flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors">
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

            <!-- Master Data (with Submenu) -->
            <div class="submenu-container">
                <button onclick="toggleSubmenu(this)" class="menu-item w-full flex items-center justify-between px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-database w-5 text-center"></i>
                        <span class="sidebar-text">Master Data</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs sidebar-text transition-transform duration-300"></i>
                </button>
                <div class="submenu pl-8 space-y-1 mt-1">
                    <a href="form-kategori-aset.html" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 text-sm text-white/80 hover:text-white transition-colors">
                        <i class="fas fa-tag w-4 text-center text-xs"></i>
                        <span>Kategori Aset</span>
                    </a>
                    <a href="form-kondisi-aset.html" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 text-sm text-white/80 hover:text-white transition-colors">
                        <i class="fas fa-stethoscope w-4 text-center text-xs"></i>
                        <span>Kondisi Aset</span>
                    </a>
                </div>
            </div>
            
            <!-- Manajemen User -->
            <a href="manajemenuser.html" class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors">
                <i class="fas fa-users-gear w-5 text-center"></i>
                <span class="sidebar-text">Manajemen User</span>
            </a>
        </nav>
        
        <!-- User Profile (Bottom) -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10 bg-gov-primary-dark">
            <div class="flex items-center gap-3">
                <div class="sidebar-text flex-1 min-w-0">
                    <p class="text-sm font-medium truncate">Admin Dinas</p>
                    <p class="text-xs text-white/60 truncate">admin@sipaset.go.id</p>
                </div>
                <button class="sidebar-text p-2 hover:bg-white/10 rounded-lg transition-colors" title="Logout">
                    <i class="fas fa-right-from-bracket text-sm"></i>
                </button>
            </div>
        </div>
    </aside>
    
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
                        <h1 class="text-lg font-semibold text-gray-800">Dashboard</h1>
                        <p class="text-xs text-gray-500 hidden sm:block">Selamat datang di SIP-ASET</p>
                    </div>
                </div>
                
                <!-- Right: Actions -->
                <div class="flex items-center gap-2 sm:gap-4">
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <main class="p-4 lg:p-6">
            
            <!-- Statistics Cards -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
                <!-- Total Aset -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Total Aset</p>
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">2,847</h3>
                            <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-up"></i>
                                <span>12% dari bulan lalu</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-boxes-stacked text-gov-primary text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Nilai Aset removed per user request -->
                
                <!-- Aset Rusak -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow border-l-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Aset Rusak/Perbaikan</p>
                            <h3 class="text-2xl lg:text-3xl font-bold text-red-600">127</h3>
                            <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Perlu tindakan</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-screwdriver-wrench text-red-500 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Aset Digunakan -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Aset Digunakan</p>
                            <h3 class="text-2xl lg:text-3xl font-bold text-green-600">2,593</h3>
                            <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                                <i class="fas fa-check-circle"></i>
                                <span>91% dari total aset</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clipboard-check text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Charts Section -->
            <section class="grid grid-cols-1 gap-4 lg:gap-6 mb-6">
                <!-- Donut Chart: Kondisi Aset -->
                <div class="bg-white rounded-xl shadow-sm p-6 chart-card">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Kondisi Aset</h3>
                        <p class="text-sm text-gray-500 mt-1">Distribusi kondisi aset berdasarkan status pemeliharaan</p>
                    </div>
                    
                    <!-- Chart Container -->
                    <div class="flex flex-col lg:flex-row items-center justify-center gap-8">
                        <!-- Donut Chart -->
                        <div class="flex-shrink-0">
                            <div class="relative w-56 h-56">
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 120 120">
                                    <!-- Background circle -->
                                    <circle cx="60" cy="60" r="45" fill="none" stroke="#e5e7eb" stroke-width="14"/>
                                    <!-- Baik (75%) - Blue -->
                                    <circle cx="60" cy="60" r="45" fill="none" stroke="#2563eb" stroke-width="14" 
                                        stroke-dasharray="212.05 282.73" stroke-dashoffset="0" stroke-linecap="round"/>
                                    <!-- Rusak Ringan (15%) - Amber -->
                                    <circle cx="60" cy="60" r="45" fill="none" stroke="#f59e0b" stroke-width="14" 
                                        stroke-dasharray="42.41 282.73" stroke-dashoffset="-212.05" stroke-linecap="round"/>
                                    <!-- Rusak Berat (10%) - Red -->
                                    <circle cx="60" cy="60" r="45" fill="none" stroke="#ef4444" stroke-width="14" 
                                        stroke-dasharray="28.27 282.73" stroke-dashoffset="-254.46" stroke-linecap="round"/>
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center bg-gradient-to-br from-transparent to-transparent">
                                    <span class="text-4xl font-bold text-gray-800">75%</span>
                                    <span class="text-sm text-gray-500 mt-1">Kondisi Baik</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Legend & Stats -->
                        <div class="space-y-4 flex-1 min-w-[280px]">
                            <!-- Baik -->
                            <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-lg border border-blue-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-center flex-shrink-0">
                                    <span class="w-4 h-4 rounded-full bg-blue-500"></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800">Baik</p>
                                    <p class="text-xs text-gray-600 mt-0.5">Kondisi optimal, layak pakai</p>
                                    <p class="text-lg font-bold text-blue-600 mt-2">2,135 aset <span class="text-sm text-gray-500 font-normal">(75%)</span></p>
                                </div>
                            </div>
                            
                            <!-- Rusak Ringan -->
                            <div class="flex items-start gap-4 p-4 bg-amber-50 rounded-lg border border-amber-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-center flex-shrink-0">
                                    <span class="w-4 h-4 rounded-full bg-amber-500"></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800">Rusak Ringan</p>
                                    <p class="text-xs text-gray-600 mt-0.5">Perlu perbaikan minor</p>
                                    <p class="text-lg font-bold text-amber-600 mt-2">427 aset <span class="text-sm text-gray-500 font-normal">(15%)</span></p>
                                </div>
                            </div>
                            
                            <!-- Rusak Berat -->
                            <div class="flex items-start gap-4 p-4 bg-red-50 rounded-lg border border-red-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-center flex-shrink-0">
                                    <span class="w-4 h-4 rounded-full bg-red-500"></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800">Rusak Berat</p>
                                    <p class="text-xs text-gray-600 mt-0.5">Perlu perbaikan besar</p>
                                    <p class="text-lg font-bold text-red-600 mt-2">285 aset <span class="text-sm text-gray-500 font-normal">(10%)</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Recent Assets Table -->
            <section class="bg-white rounded-xl shadow-sm">
                <div class="p-5 border-b border-gray-100">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <h3 class="font-semibold text-gray-800">Aset Terbaru</h3>
                        <div class="flex items-center gap-2">
                            <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 flex-1 sm:flex-none">
                                <i class="fas fa-search text-gray-400 text-sm"></i>
                                <input type="text" placeholder="Cari aset..." class="bg-transparent border-none outline-none ml-2 text-sm w-full sm:w-40">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Table Container -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="text-center px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Aset</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Lokasi</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <!-- Row 1 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center text-sm text-gray-600">1</td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-800">Router Cisco ASR 1000</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">Jaringan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Gudang</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Baik</span>
                                </td>
                            </tr>
                            
                            <!-- Row 2 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center text-sm text-gray-600">2</td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-800">Switch Cisco Catalyst 9300</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">Jaringan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Gudang</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Baik</span>
                                </td>
                            </tr>
                            
                            <!-- Row 3 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center text-sm text-gray-600">3</td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-800">Access Point Ubiquiti 6E</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">Jaringan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Gudang</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Baik</span>
                                </td>
                            </tr>
                            
                            <!-- Row 4 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center text-sm text-gray-600">4</td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-800">NAS Storage 24Bay Dell</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">Jaringan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Gudang</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Baik</span>
                                </td>
                            </tr>
                            
                            <!-- Row 5 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center text-sm text-gray-600">5</td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-800">Kabel Fiber Optik 1KM</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">Jaringan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Gudang</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Baik</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            
        </main>
        
    </div>
    
    <!-- JavaScript -->
    <script>
        // Toggle Sidebar (Mobile)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        
        // Toggle Submenu
        function toggleSubmenu(button) {
            const container = button.closest('.submenu-container');
            const submenu = container.querySelector('.submenu');
            const chevron = button.querySelector('.fa-chevron-down');
            
            submenu.classList.toggle('open');
            chevron.classList.toggle('rotate-180');
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
        
        // Active menu highlight
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (!this.closest('.submenu-container') || !this.querySelector('.fa-chevron-down')) {
                    document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });
        
        // Auto-sync dark mode from localStorage (set from Pengaturan page)
        function syncDarkMode() {
            const darkModePreference = localStorage.getItem('darkMode');
            
            if (darkModePreference === 'enabled') {
                document.documentElement.classList.add('dark-mode');
                document.body.classList.add('dark-mode');
            } else {
                document.documentElement.classList.remove('dark-mode');
                document.body.classList.remove('dark-mode');
            }
        }
        
        // Apply dark mode immediately
        syncDarkMode();
        
        // Also sync on DOMContentLoaded
        window.addEventListener('DOMContentLoaded', function() {
            syncDarkMode();
        });
        
        // Listen for storage changes (when settings are changed in another tab/window)
        window.addEventListener('storage', function(e) {
            if (e.key === 'darkMode') {
                syncDarkMode();
            }
        });
    </script>
    
</body>
</html>
