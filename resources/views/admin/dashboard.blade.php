<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-admin.css') }}">
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
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-800">
    {{ number_format($totalAset) }}
</h3>

<p class="text-sm mt-1
    @if($trenAset == 'naik') text-green-600
    @elseif($trenAset == 'turun') text-red-600
    @else text-gray-500
    @endif
">
    @if($trenAset == 'naik')
        ▲ {{ $selisihAset }} aset naik dibanding bulan lalu
    @elseif($trenAset == 'turun')
        ▼ {{ abs($selisihAset) }} aset turun dibanding bulan lalu
    @else
        ● Tidak ada perubahan dari bulan lalu
    @endif
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
                            <h3 class="text-2xl lg:text-3xl font-bold text-red-600">
    {{ number_format($asetRusak) }}
</h3>

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
                            <h3 class="text-2xl lg:text-3xl font-bold text-green-600">
    {{ number_format($asetDigunakan) }}
</h3>
                            <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
    <i class="fas fa-check-circle"></i>
    <span>{{ $persenDigunakan }}% dari total aset</span></p>
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
                                    <circle cx="60" cy="60" r="45"
                                    fill="none" stroke="#10b981" stroke-width="14"
                                    stroke-dasharray="{{ $baikDash }} {{ $circumference }}"
                                    stroke-dashoffset="0"/>
                                    <!-- Rusak Ringan (15%) - Amber -->
                                    <circle cx="60" cy="60" r="45"
                                    fill="none" stroke="#f59e0b" stroke-width="14"
                                    stroke-dasharray="{{ $rrDash }} {{ $circumference }}"
                                    stroke-dashoffset="-{{ $baikDash }}"/>
                                    <!-- Rusak Berat (10%) - Red -->
                                    <circle cx="60" cy="60" r="45"
                                    fill="none" stroke="#ef4444" stroke-width="14"
                                    stroke-dasharray="{{ $rbDash }} {{ $circumference }}"
                                    stroke-dashoffset="-{{ $baikDash + $rrDash }}"/>
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
        
    </script>
    
</body>
</html>
