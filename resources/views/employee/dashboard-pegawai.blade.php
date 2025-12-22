<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
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
            <a href="dashboard-pegawai.html" class="menu-item active flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors">
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
                        <h1 class="text-lg font-semibold text-gray-800">Dashboard Pegawai</h1>
                        <p class="text-xs text-gray-500 hidden sm:block">Ringkasan data aset yang dimiliki</p>
                    </div>
                </div>
                
                <!-- Right: Actions -->
                <div class="flex items-center gap-2 sm:gap-4">
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-4 lg:p-6">
            
            <!-- Statistics Cards -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
                <!-- Total Aset -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base text-gray-500 mb-1">Total Aset</p>
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">156</h3>
                            <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-up"></i>
                                <span>13 bulan ini</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-boxes text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Kondisi Baik -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base text-gray-500 mb-1">Kondisi Baik</p>
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">148</h3>
                            <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                                <span>95%</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Rusak Ringan -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base text-gray-500 mb-1">Rusak Ringan</p>
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">8</h3>
                            <p class="text-xs text-yellow-600 mt-2 flex items-center gap-1">
                                <span>5%</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Rusak Berat -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base text-gray-500 mb-1">Rusak Berat</p>
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">0</h3>
                            <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                <span>0%</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-times-circle text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Charts Section -->
            <section class="grid grid-cols-1 gap-4 lg:gap-6 mb-6">
                <!-- Donut Chart: Kondisi Aset -->
                <div class="bg-white rounded-xl shadow-sm p-6">
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
                                    <!-- Baik (94%) - Green -->
                                    <circle cx="60" cy="60" r="45" fill="none" stroke="#10b981" stroke-width="14" 
                                        stroke-dasharray="265.49 282.73" stroke-dashoffset="0" stroke-linecap="round"/>
                                    <!-- Rusak Ringan (5%) - Yellow -->
                                    <circle cx="60" cy="60" r="45" fill="none" stroke="#f59e0b" stroke-width="14" 
                                        stroke-dasharray="14.14 282.73" stroke-dashoffset="-265.49" stroke-linecap="round"/>
                                    <!-- Rusak Berat (1%) - Red -->
                                    <circle cx="60" cy="60" r="45" fill="none" stroke="#ef4444" stroke-width="14" 
                                        stroke-dasharray="2.83 282.73" stroke-dashoffset="-279.63" stroke-linecap="round"/>
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span class="text-4xl font-bold text-gray-800">94%</span>
                                    <span class="text-sm text-gray-500 mt-1">Kondisi Baik</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Legend & Stats -->
                        <div class="space-y-4 flex-1 min-w-[280px]">
                            <!-- Baik -->
                            <div class="flex items-start gap-4 p-4 bg-green-50 rounded-lg border border-green-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-center flex-shrink-0">
                                    <span class="w-4 h-4 rounded-full bg-green-500"></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800">Baik</p>
                                    <p class="text-xs text-gray-600 mt-0.5">Kondisi optimal, layak pakai</p>
                                    <p class="text-lg font-bold text-green-600 mt-2">148 aset <span class="text-sm text-gray-500 font-normal">(94%)</span></p>
                                </div>
                            </div>
                            
                            <!-- Rusak Ringan -->
                            <div class="flex items-start gap-4 p-4 bg-yellow-50 rounded-lg border border-yellow-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-center flex-shrink-0">
                                    <span class="w-4 h-4 rounded-full bg-yellow-500"></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800">Rusak Ringan</p>
                                    <p class="text-xs text-gray-600 mt-0.5">Perlu perbaikan minor</p>
                                    <p class="text-lg font-bold text-yellow-600 mt-2">8 aset <span class="text-sm text-gray-500 font-normal">(5%)</span></p>
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
                                    <p class="text-lg font-bold text-red-600 mt-2">0 aset <span class="text-sm text-gray-500 font-normal">(1%)</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Aset Terbaru -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Aset Terbaru</h3>
                    <div class="space-y-3">
                        <div class="p-3 border border-gray-200 rounded-lg hover:border-blue-500 transition-colors">
                            <p class="font-medium text-sm text-gray-800">Monitor Samsung 27"</p>
                            <p class="text-xs text-gray-500 mt-1">10 Des 2025 • Perangkat Kantor</p>
                        </div>
                        <div class="p-3 border border-gray-200 rounded-lg hover:border-blue-500 transition-colors">
                            <p class="font-medium text-sm text-gray-800">Keyboard Logitech MX</p>
                            <p class="text-xs text-gray-500 mt-1">08 Des 2025 • Perangkat Kantor</p>
                        </div>
                        <div class="p-3 border border-gray-200 rounded-lg hover:border-blue-500 transition-colors">
                            <p class="font-medium text-sm text-gray-800">Mouse Wireless</p>
                            <p class="text-xs text-gray-500 mt-1">05 Des 2025 • Perangkat Kantor</p>
                        </div>
                        <div class="p-3 border border-gray-200 rounded-lg hover:border-blue-500 transition-colors">
                            <p class="font-medium text-sm text-gray-800">Laptop Dell Inspiron</p>
                            <p class="text-xs text-gray-500 mt-1">02 Des 2025 • Komputer</p>
                        </div>
                    </div>
                    <!-- Pagination for Recent Assets -->
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200">
                        <div class="text-xs text-gray-600">
                            Menampilkan <span class="font-semibold">1</span> hingga <span class="font-semibold">4</span> dari <span class="font-semibold">50</span> aset terbaru
                        </div>
                        <div class="flex items-center gap-1">
                            <button class="px-2 py-1 border border-gray-200 rounded text-gray-600 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed text-xs" disabled>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="px-2 py-1 bg-blue-600 text-white rounded text-xs font-medium">1</button>
                            <button class="px-2 py-1 border border-gray-200 rounded text-gray-600 hover:bg-gray-50 transition-colors text-xs">2</button>
                            <button class="px-2 py-1 border border-gray-200 rounded text-gray-600 hover:bg-gray-50 transition-colors text-xs">...</button>
                            <button class="px-2 py-1 border border-gray-200 rounded text-gray-600 hover:bg-gray-50 transition-colors text-xs">13</button>
                            <button class="px-2 py-1 border border-gray-200 rounded text-gray-600 hover:bg-gray-50 transition-colors text-xs">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
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
    
</body>
</html>
