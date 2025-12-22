<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aset Terpakai - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
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
            <a href="dashboard-admin.html" class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors">
                <i class="fas fa-chart-pie w-5 text-center"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
            
            <!-- Data Aset (with Submenu) -->
            <div class="submenu-container">
                <button onclick="toggleSubmenu(this)" class="menu-item active w-full flex items-center justify-between px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-boxes-stacked w-5 text-center"></i>
                        <span class="sidebar-text">Data Aset</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs sidebar-text transition-transform duration-300 rotate-180"></i>
                </button>
                <div class="submenu pl-8 space-y-1 mt-1 open">
                    <a href="aset-baru.html" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 text-sm text-white/80 hover:text-white transition-colors">
                        <i class="fas fa-box w-4 text-center text-xs"></i>
                        <span>Aset Baru</span>
                    </a>
                    <a href="aset-terpakai.html" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-white/10 text-sm text-white transition-colors">
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
        <main class="p-4 lg:p-6">
            
            <!-- Stats Cards -->
            <section class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-5 mb-6">
                <!-- Total Aset Terpakai -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Total Terpakai</p>
                            <h3 class="text-xl lg:text-2xl font-bold text-gray-800">2,691</h3>
                            <p class="text-xs text-blue-600 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-up"></i>
                                <span>24 bulan ini</span>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-box-open text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Kondisi Baik -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Kondisi Baik</p>
                            <h3 class="text-xl lg:text-2xl font-bold text-gray-800">2,458</h3>
                            <p class="text-xs text-green-600 mt-2">91% dari total</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-circle-check text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Kondisi Rusak Ringan -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Rusak Ringan</p>
                            <h3 class="text-xl lg:text-2xl font-bold text-gray-800">187</h3>
                            <p class="text-xs text-amber-600 mt-2">7% dari total</p>
                        </div>
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-triangle-exclamation text-amber-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Kondisi Rusak Berat -->
                <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Rusak Berat</p>
                            <h3 class="text-xl lg:text-2xl font-bold text-gray-800">46</h3>
                            <p class="text-xs text-red-600 mt-2">2% dari total</p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-circle-xmark text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Filter & Actions Bar -->
            <section class="bg-white rounded-xl shadow-sm p-4 mb-6">
                <div class="flex flex-col sm:flex-row items-end gap-3 justify-between">
                    <!-- Filter by Kategori Utama -->
                    <div class="w-full sm:w-auto">
                        <select id="mainCategoryFilter" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" onchange="filterAssets()">
                            <option value="">Semua</option>
                            <option value="infrastruktur-pasif">Infrastruktur Pasif</option>
                            <option value="perangkat-aktif">Perangkat Aktif</option>
                            <option value="power">Power</option>
                            <option value="tools">Tools</option>
                        </select>
                    </div>
                    
                    <!-- Right Side: Search + Button -->
                    <div class="flex flex-col sm:flex-row items-end gap-2 w-full sm:w-auto">
                        <!-- Search Bar -->
                        <div class="relative w-full sm:w-48">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text" id="searchInput" placeholder="Cari aset..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" onkeyup="filterAssets()">
                        </div>
                        
                        <!-- Tombol Tambah Aset -->
                        <div class="w-full sm:w-auto">
                            <a href="form-alokasi-aset.html" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-gov-primary text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                <i class="fas fa-plus"></i>
                                <span>Tambah</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Grid View (Hidden by default) -->
            <section id="gridView" class="hidden mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    
                    <!-- Asset Card 1 - Kondisi Baik -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden group">
                        <div class="h-32 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center relative">
                            <span class="absolute top-3 right-3 px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                Baik
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-1">Laptop Dell Latitude 5520</h4>
                            <p class="text-sm text-gray-500 mb-2">Elektronik</p>
                            <!-- User Info -->
                            <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg mb-3">
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-gray-700 truncate">Budi Santoso</p>
                                    <p class="text-xs text-gray-400 truncate">Bag. Keuangan</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <span>15 Jan 2024</span>
                                <div class="flex items-center gap-1">
                                    <button onclick="openDetailModal(1)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDelete('Laptop Dell Latitude 5520')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Asset Card 2 - Kondisi Baik -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden group">
                        <div class="h-32 bg-gradient-to-br from-purple-50 to-purple-100 flex items-center justify-center relative">
                            <span class="absolute top-3 right-3 px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                Baik
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-1">Monitor Samsung 27"</h4>
                            <p class="text-sm text-gray-500 mb-2">Elektronik</p>
                            <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg mb-3">
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-gray-700 truncate">Siti Aminah</p>
                                    <p class="text-xs text-gray-400 truncate">Bag. Kepegawaian</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <span>20 Feb 2024</span>
                                <div class="flex items-center gap-1">
                                    <button onclick="openDetailModal(2)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDelete('Monitor Samsung 27 inch')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Asset Card 3 - Rusak Ringan -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden group">
                        <div class="h-32 bg-gradient-to-br from-amber-50 to-amber-100 flex items-center justify-center relative">
                            <span class="absolute top-3 right-3 px-2 py-1 bg-amber-100 text-amber-700 text-xs font-medium rounded-full">
                                Rusak Ringan
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-1">Printer HP LaserJet Pro</h4>
                            <p class="text-sm text-gray-500 mb-2">Elektronik</p>
                            <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg mb-3">
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-gray-700 truncate">Ahmad Hidayat</p>
                                    <p class="text-xs text-gray-400 truncate">Bag. Umum</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <span>05 Mar 2023</span>
                                <div class="flex items-center gap-1">
                                    <button onclick="openDetailModal(3)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDelete('Printer HP LaserJet Pro')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Asset Card 4 - Kondisi Baik -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden group">
                        <div class="h-32 bg-gradient-to-br from-teal-50 to-teal-100 flex items-center justify-center relative">
                            <span class="absolute top-3 right-3 px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                Baik
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-1">Kursi Kerja Ergonomis</h4>
                            <p class="text-sm text-gray-500 mb-2">Furniture</p>
                            <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg mb-3">
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-gray-700 truncate">Dewi Lestari</p>
                                    <p class="text-xs text-gray-400 truncate">Bag. Perencanaan</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <span>10 Jan 2024</span>
                                <div class="flex items-center gap-1">
                                    <button onclick="openDetailModal(4)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDelete('Kursi Kerja Ergonomis')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Asset Card 5 - Rusak Berat -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden group">
                        <div class="h-32 bg-gradient-to-br from-red-50 to-red-100 flex items-center justify-center relative">
                            <span class="absolute top-3 right-3 px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">
                                Rusak Berat
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-1">AC Daikin 2 PK</h4>
                            <p class="text-sm text-gray-500 mb-2">Elektronik</p>
                            <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg mb-3">
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-gray-700 truncate">Ruang Rapat Lt.2</p>
                                    <p class="text-xs text-gray-400 truncate">Bag. Umum</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <span>15 Jun 2021</span>
                                <div class="flex items-center gap-1">
                                    <button onclick="openDetailModal(5)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDelete('AC Daikin 2 PK')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Asset Card 6 - Kondisi Baik -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden group">
                        <div class="h-32 bg-gradient-to-br from-rose-50 to-rose-100 flex items-center justify-center relative">
                            <span class="absolute top-3 right-3 px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                Baik
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-1">Meja Kerja 160x80 cm</h4>
                            <p class="text-sm text-gray-500 mb-2">Furniture</p>
                            <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg mb-3">
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-gray-700 truncate">Rudi Hartono</p>
                                    <p class="text-xs text-gray-400 truncate">Bag. Keuangan</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <span>22 Aug 2022</span>
                                <div class="flex items-center gap-1">
                                    <button onclick="openDetailModal(6)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDelete('Meja Kerja 160x80 cm')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Asset Card 7 - Kondisi Baik -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden group">
                        <div class="h-32 bg-gradient-to-br from-indigo-50 to-indigo-100 flex items-center justify-center relative">
                            <span class="absolute top-3 right-3 px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                Baik
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-1">Mobil Dinas Toyota Innova</h4>
                            <p class="text-sm text-gray-500 mb-2">Kendaraan</p>
                            <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg mb-3">
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-gray-700 truncate">Kepala Dinas</p>
                                    <p class="text-xs text-gray-400 truncate">Pimpinan</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <span>10 Mar 2023</span>
                                <div class="flex items-center gap-1">
                                    <button onclick="openDetailModal(7)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDelete('Mobil Dinas Toyota Innova')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Asset Card 8 - Rusak Ringan -->
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden group">
                        <div class="h-32 bg-gradient-to-br from-cyan-50 to-cyan-100 flex items-center justify-center relative">
                            <span class="absolute top-3 right-3 px-2 py-1 bg-amber-100 text-amber-700 text-xs font-medium rounded-full">
                                Rusak Ringan
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-1">Mesin Fax Panasonic</h4>
                            <p class="text-sm text-gray-500 mb-2">Elektronik</p>
                            <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg mb-3">
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-gray-700 truncate">Ruang Sekretariat</p>
                                    <p class="text-xs text-gray-400 truncate">Bag. Umum</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <span>05 Nov 2020</span>
                                <div class="flex items-center gap-1">
                                    <button onclick="openDetailModal(8)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDelete('Mesin Fax Panasonic')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
            
            <!-- Table View -->
            <section id="tableView" class="mb-6">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="text-center px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Aset</th>
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kondisi</th>
                                    <th class="text-center px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 sm:px-6 py-4 text-center text-sm text-gray-600">1</td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <span class="font-medium text-gray-800">Laptop Dell Latitude 5520</span>
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Elektronik</td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <span class="px-1.5 sm:px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full inline-block">Baik</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-1">
                                            <button onclick="openDetailModal(1)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button onclick="openEditModalDirect(1)" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="confirmDelete('Laptop Dell Latitude 5520')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 sm:px-6 py-4 text-center text-sm text-gray-600">2</td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <span class="font-medium text-gray-800">Monitor Samsung 27"</span>
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Elektronik</td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <span class="px-1.5 sm:px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full inline-block">Baik</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-1">
                                            <button onclick="openDetailModal(2)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button onclick="openEditModalDirect(2)" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="confirmDelete('Monitor Samsung 27 inch')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 sm:px-6 py-4 text-center text-sm text-gray-600">3</td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <span class="font-medium text-gray-800">Printer HP LaserJet Pro</span>
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Elektronik</td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <span class="px-1.5 sm:px-3 py-1 bg-amber-100 text-amber-700 text-xs font-medium rounded-full inline-block">
                                            <span class="hidden sm:inline">Rusak Ringan</span>
                                            <span class="sm:hidden">R. Ringan</span>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-1">
                                            <button onclick="openDetailModal(3)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button onclick="openEditModalDirect(3)" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="confirmDelete('Printer HP LaserJet Pro')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 sm:px-6 py-4 text-center text-sm text-gray-600">4</td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <span class="font-medium text-gray-800">AC Daikin 2 PK</span>
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Elektronik</td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <span class="px-1.5 sm:px-3 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full inline-block">
                                            <span class="hidden sm:inline">Rusak Berat</span>
                                            <span class="sm:hidden">R. Berat</span>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-1">
                                            <button onclick="openDetailModal(4)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button onclick="openEditModalDirect(4)" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="confirmDelete('AC Daikin 2 PK')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 sm:px-6 py-4 text-center text-sm text-gray-600">5</td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <span class="font-medium text-gray-800">Mobil Dinas Toyota Innova</span>
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">Kendaraan</td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <span class="px-1.5 sm:px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full inline-block">Baik</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-1">
                                            <button onclick="openDetailModal(5)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button onclick="openEditModalDirect(5)" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="confirmDelete('Mobil Dinas Toyota Innova')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            
            <!-- Pagination -->
            <section class="bg-white rounded-xl shadow-sm p-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-500">
                        Menampilkan <span class="font-medium text-gray-700">1-8</span> dari <span class="font-medium text-gray-700">2,691</span> aset
                    </p>
                    <div class="flex items-center gap-1">
                        <button class="px-3 py-1.5 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-1.5 text-sm bg-gov-primary text-white rounded-lg">1</button>
                        <button class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">2</button>
                        <button class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">3</button>
                        <span class="px-2 text-gray-400">...</span>
                        <button class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">337</button>
                        <button class="px-3 py-1.5 text-sm text-gray-500 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </section>
            
        </main>
        
    </div>
    
    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden">
        <div id="detailBackdropDesktop" class="modal-backdrop absolute inset-0 bg-black/50 hidden lg:block" onclick="closeDetailModal()"></div>
        <div id="detailSheetDesktop" class="modal-sheet lg:modal-sheet-desktop hidden lg:block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full lg:max-w-2xl bg-white rounded-2xl shadow-xl lg:max-h-[90vh] overflow-y-auto">
            <div class="p-6 lg:p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Detail Aset Terpakai</h3>
                </div>
                
                <!-- Asset Name Header -->
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <p id="modalName" class="text-2xl font-bold text-gray-800">Laptop Dell Latitude 5520</p>
                </div>
                
                <!-- Asset Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Kode SN</p>
                        <p id="modalSN" class="font-medium text-gray-700 font-mono">SN12345678</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Alamat</p>
                        <p id="modalAlamat" class="font-medium text-gray-700">Ruang Kerja A</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Kategori</p>
                        <p id="modalCategory" class="font-medium text-gray-700">Elektronik</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Kondisi</p>
                        <span id="modalCondition" class="inline-flex px-2.5 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                            Baik
                        </span>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center gap-3 pt-6 border-t border-gray-100">
                    <button onclick="openEditModal()" class="flex-1 px-4 py-2.5 bg-gov-primary text-white rounded-lg text-sm font-medium hover:bg-gov-primary-dark transition-colors">
                        Edit
                    </button>
                    <button onclick="closeDetailModal()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Bottom Sheet Version -->
        <div id="detailSheetMobile" class="lg:hidden fixed inset-0 z-50 hidden flex flex-col">
            <div id="detailBackdropMobile" class="modal-backdrop absolute inset-0 bg-black/50" onclick="closeDetailModal()"></div>
            <div class="modal-sheet relative mt-auto">
                <div class="modal-sheet-handle"></div>
                <div class="modal-sheet-content p-6">
                    <!-- Header -->
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Detail Aset</h3>
                    </div>
                    
                    <!-- Asset Name Header -->
                    <div class="mb-4 pb-4 border-b border-gray-200">
                        <p id="modalNameMobile" class="text-lg font-bold text-gray-800">Laptop Dell Latitude</p>
                    </div>
                    
                    <!-- Asset Info Grid -->
                    <div class="space-y-3 mb-4">
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Kode SN</p>
                            <p id="modalSNMobile" class="font-medium text-gray-800 text-sm font-mono">SN12345678</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Alamat</p>
                            <p id="modalAlamatMobile" class="font-medium text-gray-800 text-sm">Ruang Kerja A</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Kategori</p>
                            <p id="modalCategoryMobile" class="font-medium text-gray-800 text-sm">Elektronik</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Kondisi</p>
                            <p id="modalConditionMobile" class="font-medium text-gray-800 text-sm">Baik</p>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex flex-col gap-2 pt-4 border-t border-gray-200">
                        <button onclick="openEditModal()" class="w-full px-4 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            Edit
                        </button>
                        <button onclick="closeDetailModal()" class="w-full px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-50 hidden">
        <div id="editBackdropDesktop" class="modal-backdrop absolute inset-0 bg-black/50 hidden lg:block" onclick="closeEditModal()"></div>
        <div id="editSheetDesktop" class="modal-sheet lg:modal-sheet-desktop hidden lg:block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full lg:max-w-2xl bg-white rounded-2xl shadow-xl lg:max-h-[90vh] overflow-y-auto">
            <div class="p-6 lg:p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Edit Data Aset</h3>
                    <button onclick="closeEditModal()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="editForm" onsubmit="handleEditSubmit(event)">
                    <!-- Nama Aset -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Aset</label>
                        <input type="text" id="editName" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary" required>
                    </div>
                    
                    <!-- Grid: Kategori & Kode SN -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Kategori -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select id="editCategory" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Jaringan">Jaringan</option>
                                <option value="Penyimpanan">Penyimpanan</option>
                            </select>
                        </div>
                        
                        <!-- Kode SN -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode SN</label>
                            <input type="text" id="editSN" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm font-mono focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary" required>
                        </div>
                    </div>
                    
                    <!-- Alamat/Lokasi -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat/Lokasi</label>
                        <input type="text" id="editAlamat" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary" required>
                    </div>
                    
                    <!-- Kondisi -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                        <select id="editCondition" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary" required>
                            <option value="">Pilih Kondisi</option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center gap-3 pt-6 border-t border-gray-100">
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                            Simpan Perubahan
                        </button>
                        <button type="button" onclick="closeEditModal()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Mobile Bottom Sheet Version -->
        <div id="editSheetMobile" class="lg:hidden fixed inset-0 z-50 hidden flex flex-col">
            <div id="editBackdropMobile" class="modal-backdrop absolute inset-0 bg-black/50" onclick="closeEditModal()"></div>
            <div class="modal-sheet relative mt-auto">
                <div class="modal-sheet-handle"></div>
                <div class="modal-sheet-content p-6">
                    <!-- Header -->
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Edit Aset</h3>
                    </div>
                    
                    <!-- Form -->
                    <form onsubmit="handleEditSubmit(event)" class="space-y-3">
                        <!-- Nama Aset -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Nama Aset</label>
                            <input type="text" id="editNameMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>
                        
                        <!-- Kategori -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Kategori</label>
                            <select id="editCategoryMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Jaringan">Jaringan</option>
                                <option value="Penyimpanan">Penyimpanan</option>
                            </select>
                        </div>
                        
                        <!-- Kode SN -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Kode SN</label>
                            <input type="text" id="editSNMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>
                        
                        <!-- Alamat/Lokasi -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Alamat/Lokasi</label>
                            <input type="text" id="editAlamatMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>
                        
                        <!-- Kondisi -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Kondisi</label>
                            <select id="editConditionMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex gap-2 pt-3 border-t border-gray-200">
                            <button type="submit" class="flex-1 px-4 py-2.5 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                                Simpan
                            </button>
                            <button type="button" onclick="closeEditModal()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script>
        // Check if mobile
        function isMobile() {
            return window.innerWidth < 1024;
        }
        
        // Get condition badge class
        function getConditionBadgeClass(condition) {
            let classes = 'inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full ';
            switch(condition) {
                case 'Baik':
                    return classes + 'bg-green-100 text-green-700';
                case 'Rusak Ringan':
                    return classes + 'bg-amber-100 text-amber-700';
                case 'Rusak Berat':
                    return classes + 'bg-red-100 text-red-700';
                default:
                    return classes + 'bg-gray-100 text-gray-700';
            }
        }

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
        
        // View Toggle (Grid/Table)
        function setView(view) {
            const gridView = document.getElementById('gridView');
            const tableView = document.getElementById('tableView');
            const gridBtn = document.getElementById('gridViewBtn');
            const tableBtn = document.getElementById('tableViewBtn');
            
            if (view === 'grid') {
                gridView.classList.remove('hidden');
                tableView.classList.add('hidden');
                gridBtn.classList.add('bg-white', 'shadow-sm', 'text-gray-700');
                gridBtn.classList.remove('text-gray-500');
                tableBtn.classList.remove('bg-white', 'shadow-sm', 'text-gray-700');
                tableBtn.classList.add('text-gray-500');
            } else {
                gridView.classList.add('hidden');
                tableView.classList.remove('hidden');
                tableBtn.classList.add('bg-white', 'shadow-sm', 'text-gray-700');
                tableBtn.classList.remove('text-gray-500');
                gridBtn.classList.remove('bg-white', 'shadow-sm', 'text-gray-700');
                gridBtn.classList.add('text-gray-500');
            }
        }
        
        // Detail Modal - Mobile Responsive
        function openDetailModal(id) {
            const detailModal = document.getElementById('detailModal');
            
            if (isMobile()) {
                const mobileSheet = document.getElementById('detailSheetMobile');
                mobileSheet.classList.remove('hidden');
                mobileSheet.classList.add('modal-mobile-visible');
            } else {
                const desktopSheet = document.getElementById('detailSheetDesktop');
                desktopSheet.classList.remove('hidden');
            }
            
            detailModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Sample data
            const assetData = {
                1: {
                    name: 'Laptop Dell Latitude 5520',
                    sn: 'SN-DELL-2024-001',
                    alamat: 'Ruang Kerja A',
                    category: 'Elektronik',
                    condition: 'Baik'
                },
                2: {
                    name: 'Monitor Samsung 27"',
                    sn: 'SN-SAMSUNG-2024-002',
                    alamat: 'Ruang Kerja B',
                    category: 'Elektronik',
                    condition: 'Baik'
                },
                3: {
                    name: 'Printer HP LaserJet Pro',
                    sn: 'SN-HP-2023-001',
                    alamat: 'Ruang Arsip',
                    category: 'Elektronik',
                    condition: 'Rusak Ringan'
                }
            };
            
            const data = assetData[id] || assetData[1];
            
            // Update desktop version
            document.getElementById('modalName').textContent = data.name;
            document.getElementById('modalSN').textContent = data.sn;
            document.getElementById('modalAlamat').textContent = data.alamat;
            document.getElementById('modalCategory').textContent = data.category;
            document.getElementById('modalCondition').textContent = data.condition;
            document.getElementById('modalCondition').className = getConditionBadgeClass(data.condition);
            
            // Update mobile version
            document.getElementById('modalNameMobile').textContent = data.name;
            document.getElementById('modalSNMobile').textContent = data.sn;
            document.getElementById('modalAlamatMobile').textContent = data.alamat;
            document.getElementById('modalCategoryMobile').textContent = data.category;
            document.getElementById('modalConditionMobile').textContent = data.condition;
            
            window.currentAssetId = id;
        }
        
        function closeDetailModal() {
            const detailModal = document.getElementById('detailModal');
            
            if (isMobile()) {
                const mobileSheet = document.getElementById('detailSheetMobile');
                mobileSheet.classList.remove('modal-mobile-visible');
                mobileSheet.classList.add('modal-mobile-hiding');
                
                setTimeout(() => {
                    detailModal.classList.add('hidden');
                    mobileSheet.classList.remove('modal-mobile-hiding');
                    mobileSheet.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 400);
            } else {
                const desktopSheet = document.getElementById('detailSheetDesktop');
                desktopSheet.classList.add('hidden');
                detailModal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }
        
        // Edit Modal - Mobile Responsive
        function openEditModal() {
            closeDetailModal();
            
            const editModal = document.getElementById('editModal');
            
            if (isMobile()) {
                const mobileSheet = document.getElementById('editSheetMobile');
                mobileSheet.classList.remove('hidden');
                mobileSheet.classList.add('modal-mobile-visible');
            } else {
                const desktopSheet = document.getElementById('editSheetDesktop');
                desktopSheet.classList.remove('hidden');
            }
            
            editModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Fill form with current data
            const name = document.getElementById('modalName').textContent;
            const sn = document.getElementById('modalSN').textContent;
            const alamat = document.getElementById('modalAlamat').textContent;
            const category = document.getElementById('modalCategory').textContent;
            const condition = document.getElementById('modalCondition').textContent;
            
            // Desktop form
            document.getElementById('editName').value = name;
            document.getElementById('editSN').value = sn;
            document.getElementById('editAlamat').value = alamat;
            document.getElementById('editCategory').value = category;
            document.getElementById('editCondition').value = condition;
            
            // Mobile form
            document.getElementById('editNameMobile').value = name;
            document.getElementById('editSNMobile').value = sn;
            document.getElementById('editAlamatMobile').value = alamat;
            document.getElementById('editCategoryMobile').value = category;
            document.getElementById('editConditionMobile').value = condition;
        }
        
        // Open Edit Modal Directly (tanpa detail modal)
        function openEditModalDirect(id) {
            const editModal = document.getElementById('editModal');
            
            // Sample data
            const assetData = {
                1: {
                    name: 'Laptop Dell Latitude 5520',
                    sn: 'SN-DELL-2024-001',
                    alamat: 'Ruang Kerja A',
                    category: 'Elektronik',
                    condition: 'Baik'
                },
                2: {
                    name: 'Monitor Samsung 27"',
                    sn: 'SN-SAMSUNG-2024-002',
                    alamat: 'Ruang Kerja B',
                    category: 'Elektronik',
                    condition: 'Baik'
                },
                3: {
                    name: 'Printer HP LaserJet Pro',
                    sn: 'SN-HP-2023-001',
                    alamat: 'Ruang Arsip',
                    category: 'Elektronik',
                    condition: 'Rusak Ringan'
                }
            };
            
            const data = assetData[id] || assetData[1];
            
            if (isMobile()) {
                const mobileSheet = document.getElementById('editSheetMobile');
                mobileSheet.classList.remove('hidden');
                mobileSheet.classList.add('modal-mobile-visible');
            } else {
                const desktopSheet = document.getElementById('editSheetDesktop');
                desktopSheet.classList.remove('hidden');
            }
            
            editModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Desktop form
            document.getElementById('editName').value = data.name;
            document.getElementById('editSN').value = data.sn;
            document.getElementById('editAlamat').value = data.alamat;
            document.getElementById('editCategory').value = data.category;
            document.getElementById('editCondition').value = data.condition;
            
            // Mobile form
            document.getElementById('editNameMobile').value = data.name;
            document.getElementById('editSNMobile').value = data.sn;
            document.getElementById('editAlamatMobile').value = data.alamat;
            document.getElementById('editCategoryMobile').value = data.category;
            document.getElementById('editConditionMobile').value = data.condition;
            
            window.currentAssetId = id;
        }
        
        function closeEditModal() {
            const editModal = document.getElementById('editModal');
            
            if (isMobile()) {
                const mobileSheet = document.getElementById('editSheetMobile');
                mobileSheet.classList.remove('modal-mobile-visible');
                mobileSheet.classList.add('modal-mobile-hiding');
                
                setTimeout(() => {
                    editModal.classList.add('hidden');
                    mobileSheet.classList.remove('modal-mobile-hiding');
                    mobileSheet.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 400);
            } else {
                const desktopSheet = document.getElementById('editSheetDesktop');
                desktopSheet.classList.add('hidden');
                editModal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }
        
        // Handle Edit Form Submit
        function handleEditSubmit(event) {
            event.preventDefault();
            
            const name = document.getElementById('editName').value.trim();
            const category = document.getElementById('editCategory').value;
            const condition = document.getElementById('editCondition').value;
            const quantity = document.getElementById('editQuantity').value;
            const allocationDate = document.getElementById('editAllocationDate').value;
            const notes = document.getElementById('editNotes').value.trim();
            
            // Validation
            if (!name || !category || !condition || !quantity || !allocationDate) {
                showErrorModal('Semua field harus diisi!');
                return;
            }
            
            if (quantity < 1) {
                showErrorModal('Jumlah harus minimal 1!');
                return;
            }
            
            // Close modal
            closeEditModal();
            
            // Show success message
            showSuccessModal();
            
            // Optionally refresh the table
            setTimeout(() => {
                location.reload();
            }, 2000);
        }
        
        // Get condition badge class
        function getConditionBadgeClass(condition) {
            const baseClass = 'inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full';
            if (condition === 'Baik') {
                return baseClass + ' bg-green-100 text-green-700';
            } else if (condition === 'Rusak Ringan') {
                return baseClass + ' bg-amber-100 text-amber-700';
            } else if (condition === 'Rusak Berat') {
                return baseClass + ' bg-red-100 text-red-700';
            }
            return baseClass + ' bg-gray-100 text-gray-700';
        }
        
        // Show Success Modal
        function showSuccessModal() {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center';
            modal.innerHTML = `
                <div class="absolute inset-0 bg-black/50" onclick="this.parentElement.remove()"></div>
                <div class="relative bg-white rounded-2xl shadow-xl p-8 max-w-sm w-full mx-4 animate-in">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Berhasil!</h3>
                    <p class="text-gray-600 text-center text-sm mb-6">Data aset telah berhasil diperbarui.</p>
                    <button onclick="this.closest('.fixed').remove()" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                        OK
                    </button>
                </div>
            `;
            document.body.appendChild(modal);
        }
        
        // Show Error Modal
        function showErrorModal(message) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center';
            modal.innerHTML = `
                <div class="absolute inset-0 bg-black/50" onclick="this.parentElement.remove()"></div>
                <div class="relative bg-white rounded-2xl shadow-xl p-8 max-w-sm w-full mx-4 animate-in">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation text-red-600 text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Kesalahan</h3>
                    <p class="text-gray-600 text-center text-sm mb-6">${message}</p>
                    <button onclick="this.closest('.fixed').remove()" class="w-full px-4 py-2.5 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">
                        OK
                    </button>
                </div>
            `;
            document.body.appendChild(modal);
        }
        
        // Confirm Delete Modal
        function confirmDelete(assetName) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center';
            modal.innerHTML = `
                <div class="absolute inset-0 bg-black/50" onclick="this.parentElement.remove()"></div>
                <div class="relative bg-white rounded-2xl shadow-xl p-8 max-w-sm w-full mx-4 animate-in">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-trash-can text-red-600 text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Hapus Aset</h3>
                    <p class="text-gray-600 text-center text-sm mb-6">Apakah Anda yakin ingin menghapus aset <strong>"${assetName}"</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="flex gap-3">
                        <button onclick="this.closest('.fixed').remove()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button onclick="executeDelete('${assetName}'); this.closest('.fixed').remove()" class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">
                            Hapus
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }
        
        // Execute Delete
        function executeDelete(assetName) {
            const successModal = document.createElement('div');
            successModal.className = 'fixed inset-0 z-50 flex items-center justify-center';
            successModal.innerHTML = `
                <div class="absolute inset-0 bg-black/50" onclick="this.parentElement.remove()"></div>
                <div class="relative bg-white rounded-2xl shadow-xl p-8 max-w-sm w-full mx-4 animate-in">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Berhasil</h3>
                    <p class="text-gray-600 text-center text-sm mb-6">Aset <strong>"${assetName}"</strong> telah berhasil dihapus.</p>
                    <button onclick="this.closest('.fixed').remove()" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                        OK
                    </button>
                </div>
            `;
            document.body.appendChild(successModal);
        }
        
        
        // Filter Assets Function
        function filterAssets() {
            // Placeholder for filtering logic
            const categoryFilter = document.getElementById('mainCategoryFilter').value;
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            
            console.log('Filtering by category:', categoryFilter);
            console.log('Search term:', searchInput);
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
        
        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailModal();
            }
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
        
        // Allocation Modal Functions
        function openAllocationModal() {
            const detailName = document.getElementById('modalName').textContent;
            const detailSN = document.getElementById('modalSN').textContent;
            const detailCategory = document.getElementById('modalCategory').textContent;
            const detailCondition = document.getElementById('modalCondition').textContent;
            
            closeDetailModal();
            
            const allocationModal = document.getElementById('allocationModal');
            
            if (isMobile()) {
                const mobileSheet = document.getElementById('allocationSheetMobile');
                mobileSheet.classList.remove('hidden');
                mobileSheet.classList.add('modal-mobile-visible');
            } else {
                const desktopSheet = document.getElementById('allocationSheetDesktop');
                desktopSheet.classList.remove('hidden');
            }
            
            allocationModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Populate asset details
            document.getElementById('allocName').textContent = detailName;
            document.getElementById('allocSN').textContent = detailSN;
            document.getElementById('allocCategory').textContent = detailCategory;
            document.getElementById('allocCondition').textContent = detailCondition;
            
            // Mobile form
            document.getElementById('allocNameMobile').textContent = detailName;
            document.getElementById('allocSNMobile').textContent = detailSN;
            document.getElementById('allocCategoryMobile').textContent = detailCategory;
            document.getElementById('allocConditionMobile').textContent = detailCondition;
            
            // Set today's date as default
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('allocDate').value = today;
            document.getElementById('allocDateMobile').value = today;
            
            window.currentAssetId = window.currentDetailId;
        }
        
        function openAllocationModalDirect(id) {
            const allocationModal = document.getElementById('allocationModal');
            
            if (isMobile()) {
                const mobileSheet = document.getElementById('allocationSheetMobile');
                mobileSheet.classList.remove('hidden');
                mobileSheet.classList.add('modal-mobile-visible');
            } else {
                const desktopSheet = document.getElementById('allocationSheetDesktop');
                desktopSheet.classList.remove('hidden');
            }
            
            allocationModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Populate asset details from assetData directly
            const data = assetData[id] || assetData[1];
            
            // Desktop form
            document.getElementById('allocName').textContent = data.name;
            document.getElementById('allocSN').textContent = data.sn;
            document.getElementById('allocCategory').textContent = data.category;
            document.getElementById('allocCondition').textContent = data.condition;
            
            // Mobile form
            document.getElementById('allocNameMobile').textContent = data.name;
            document.getElementById('allocSNMobile').textContent = data.sn;
            document.getElementById('allocCategoryMobile').textContent = data.category;
            document.getElementById('allocConditionMobile').textContent = data.condition;
            
            // Set today's date as default
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('allocDate').value = today;
            document.getElementById('allocDateMobile').value = today;
            
            window.currentAssetId = id;
        }
        
        function closeAllocationModal() {
            const allocationModal = document.getElementById('allocationModal');
            
            if (isMobile()) {
                const mobileSheet = document.getElementById('allocationSheetMobile');
                mobileSheet.classList.remove('modal-mobile-visible');
                mobileSheet.classList.add('modal-mobile-hiding');
                
                setTimeout(() => {
                    allocationModal.classList.add('hidden');
                    mobileSheet.classList.remove('modal-mobile-hiding');
                    mobileSheet.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 400);
            } else {
                const desktopSheet = document.getElementById('allocationSheetDesktop');
                desktopSheet.classList.add('hidden');
                allocationModal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }
        
        function handleAllocationSubmit(event) {
            event.preventDefault();
            
            // Get form data
            const recipientName = document.getElementById('allocRecipientName')?.value || document.getElementById('allocRecipientNameMobile')?.value;
            const position = document.getElementById('allocPosition')?.value || document.getElementById('allocPositionMobile')?.value;
            const department = document.getElementById('allocDepartment')?.value || document.getElementById('allocDepartmentMobile')?.value;
            const allocationDate = document.getElementById('allocDate')?.value || document.getElementById('allocDateMobile')?.value;
            const location = document.getElementById('allocLocation')?.value || document.getElementById('allocLocationMobile')?.value;
            const notes = document.getElementById('allocNotes')?.value || document.getElementById('allocNotesMobile')?.value;
            
            // Here you would normally send this data to a server
            console.log({
                recipientName,
                position,
                department,
                allocationDate,
                location,
                notes
            });
            
            alert(`Aset berhasil dialokasikan kepada ${recipientName}!`);
            closeAllocationModal();
            
            // Reset form
            document.getElementById('allocationForm')?.reset();
            document.getElementById('allocationFormMobile')?.reset();
        }
        
        // Asset Data for allocation
        const assetData = {
            1: { name: 'Laptop Dell Latitude 5520', sn: 'SN-DELL-LT-001', category: 'Elektronik', condition: 'Baik' },
            2: { name: 'Monitor Samsung 27"', sn: 'SN-SAMSUNG-MN-002', category: 'Elektronik', condition: 'Baik' },
            3: { name: 'Printer HP LaserJet Pro', sn: 'SN-HP-PR-003', category: 'Elektronik', condition: 'Rusak Ringan' },
            4: { name: 'AC Daikin 2 PK', sn: 'SN-DAIKIN-AC-004', category: 'Elektronik', condition: 'Rusak Berat' },
            5: { name: 'Mobil Dinas Toyota Innova', sn: 'SN-TOYOTA-VN-005', category: 'Kendaraan', condition: 'Baik' }
        };
    </script>
    
    <!-- Allocation Modal -->
    <div id="allocationModal" class="fixed inset-0 z-50 hidden">
        <div id="allocationBackdropDesktop" class="modal-backdrop absolute inset-0 bg-black/50 hidden lg:block" onclick="closeAllocationModal()"></div>
        <div id="allocationSheetDesktop" class="modal-sheet lg:modal-sheet-desktop hidden lg:block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full lg:max-w-2xl bg-white rounded-2xl shadow-xl lg:max-h-[90vh] overflow-y-auto">
            <div class="p-6 lg:p-8">
                <!-- Header -->
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Alokasi Aset</h3>
                </div>

                <!-- Asset Details Section -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3 uppercase">Detail Aset yang Dialokasikan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Nama Aset</p>
                            <p id="allocName" class="text-sm font-medium text-gray-800">-</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Kode SN</p>
                            <p id="allocSN" class="text-sm font-medium text-gray-800 font-mono">-</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Kategori</p>
                            <p id="allocCategory" class="text-sm font-medium text-gray-800">-</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Kondisi</p>
                            <p id="allocCondition" class="text-sm font-medium text-gray-800">-</p>
                        </div>
                    </div>
                </div>

                <!-- Allocation Form -->
                <form id="allocationForm" onsubmit="handleAllocationSubmit(event)">
                    <!-- Nama Penerima -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                        <input type="text" id="allocRecipientName" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Masukkan nama penerima aset" required>
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                        <input type="text" id="allocPosition" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Masukkan jabatan penerima" required>
                    </div>

                    <!-- Departemen/Bagian -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Departemen/Bagian</label>
                        <input type="text" id="allocDepartment" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Masukkan departemen/bagian" required>
                    </div>

                    <!-- Grid: Tanggal Alokasi & Lokasi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Tanggal Alokasi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Alokasi</label>
                            <input type="date" id="allocDate" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" required>
                        </div>

                        <!-- Lokasi Penempatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Penempatan</label>
                            <input type="text" id="allocLocation" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Lokasi penempatan aset" required>
                        </div>
                    </div>

                    <!-- Catatan/Keterangan -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan/Keterangan</label>
                        <textarea id="allocNotes" rows="3" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Masukkan catatan atau keterangan alokasi (opsional)"></textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3 pt-6 border-t border-gray-100">
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                            Simpan Alokasi
                        </button>
                        <button type="button" onclick="closeAllocationModal()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Mobile Bottom Sheet Version -->
        <div id="allocationSheetMobile" class="lg:hidden fixed inset-0 z-50 hidden flex flex-col">
            <div id="allocationBackdropMobile" class="modal-backdrop absolute inset-0 bg-black/50" onclick="closeAllocationModal()"></div>
            <div class="modal-sheet relative mt-auto">
                <div class="modal-sheet-handle"></div>
                <div class="modal-sheet-content p-6">
                    <!-- Header -->
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Alokasi Aset</h3>
                    </div>

                    <!-- Asset Details Section -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                        <h4 class="text-xs font-semibold text-gray-700 mb-2 uppercase">Detail Aset</h4>
                        <div class="space-y-2">
                            <div>
                                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Nama</p>
                                <p id="allocNameMobile" class="text-sm font-medium text-gray-800">-</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Kode SN</p>
                                <p id="allocSNMobile" class="text-sm font-medium text-gray-800 font-mono">-</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Kategori</p>
                                <p id="allocCategoryMobile" class="text-sm font-medium text-gray-800">-</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Kondisi</p>
                                <p id="allocConditionMobile" class="text-sm font-medium text-gray-800">-</p>
                            </div>
                        </div>
                    </div>

                    <!-- Allocation Form -->
                    <form id="allocationFormMobile" onsubmit="handleAllocationSubmit(event)" class="space-y-3">
                        <!-- Nama Penerima -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Nama Penerima</label>
                            <input type="text" id="allocRecipientNameMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Nama penerima" required>
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Jabatan</label>
                            <input type="text" id="allocPositionMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Jabatan" required>
                        </div>

                        <!-- Departemen/Bagian -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Departemen</label>
                            <input type="text" id="allocDepartmentMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Departemen" required>
                        </div>

                        <!-- Tanggal Alokasi -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Tanggal Alokasi</label>
                            <input type="date" id="allocDateMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" required>
                        </div>

                        <!-- Lokasi Penempatan -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Lokasi Penempatan</label>
                            <input type="text" id="allocLocationMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Lokasi" required>
                        </div>

                        <!-- Catatan -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1 uppercase">Catatan</label>
                            <textarea id="allocNotesMobile" rows="2" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 resize-none" placeholder="Catatan (opsional)"></textarea>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2 pt-3 border-t border-gray-200">
                            <button type="submit" class="flex-1 px-4 py-2.5 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                                Simpan
                            </button>
                            <button type="button" onclick="closeAllocationModal()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
