<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aset Baru - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

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
                        <h1 class="text-lg font-semibold text-gray-800">Aset Baru</h1>
                        <p class="text-xs text-gray-500 hidden sm:block">Daftar aset yang belum digunakan</p>
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

    <!-- Total Aset Baru -->
    <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Total Aset Baru</p>
                <h3 class="text-xl lg:text-2xl font-bold text-gray-800">
                    {{ $totalAset }}
                </h3>

                @if ($asetBaruBulanIni > 0)
                    <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                        <i class="fas fa-arrow-up"></i>
                        <span>{{ $asetBaruBulanIni }} baru bulan ini</span>
                    </p>
                @else
                    <p class="text-xs text-gray-400 mt-2">
                        Tidak ada penambahan bulan ini
                    </p>
                @endif
            </div>

            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-box text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Kondisi Baik -->
    <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Kondisi Baik</p>
                <h3 class="text-xl lg:text-2xl font-bold text-green-600">
                    {{ $baik }}
                </h3>
                <p class="text-xs text-gray-600 mt-2">
                    {{ $persenBaik }}%
                </p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Kondisi Cukup -->
    <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Kondisi Cukup</p>
                <h3 class="text-xl lg:text-2xl font-bold text-yellow-600">
                    {{ $cukup }}
                </h3>
                <p class="text-xs text-gray-600 mt-2">
                    {{ $persenCukup }}%
                </p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-exclamation-circle text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Kondisi Rusak -->
    <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-red-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Kondisi Rusak</p>
                <h3 class="text-xl lg:text-2xl font-bold text-red-600">
                    {{ $rusak }}
                </h3>
                <p class="text-xs text-gray-600 mt-2">
                    {{ $persenRusak }}%
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

        <!-- Filter Kategori -->
        <div class="w-full sm:w-auto">
            <select id="mainCategoryFilter"
                class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-600
                       focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"
                onchange="filterAssets()">
                <option value="">Semua</option>
                <option value="infrastruktur-pasif">Infrastruktur Pasif</option>
                <option value="perangkat-aktif">Perangkat Aktif</option>
                <option value="power">Power</option>
                <option value="tools">Tools</option>
            </select>
        </div>

        <!-- Search & Button -->
        <div class="flex flex-col sm:flex-row items-end gap-2 w-full sm:w-auto">

            <!-- Search -->
            <div class="relative w-full sm:w-48">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" id="searchInput" placeholder="Cari aset..."
                    class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"
                    onkeyup="filterAssets()">
            </div>

            <!-- Tambah Aset -->
            <a href="{{ route('manajemen-aset.create') }}"
               class="w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2
                      bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                <i class="fas fa-plus"></i>
                Tambah
            </a>
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
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Perolehan</th>
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="text-center px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
        @forelse ($asetBaru as $index => $aset)
        <tr class="hover:bg-gray-50 transition-colors">

            <!-- No -->
            <td class="px-6 py-4 text-center text-sm text-gray-600">
                {{ $index + 1 }}
            </td>

            <!-- Nama Aset -->
            <td class="px-6 py-4">
                <span class="font-medium text-gray-800">
                    {{ $aset->name }}
                </span>
                <div class="text-xs text-gray-400">
                    SN: {{ $aset->serialnumber }}
                </div>
            </td>

            <!-- Kategori -->
            <td class="px-6 py-4 text-sm text-gray-600">
                {{ $aset->category_code }}
            </td>

            <!-- Tanggal Perolehan -->
            <td class="px-6 py-4 text-sm text-gray-600">
                {{ \Carbon\Carbon::parse($aset->purchase_date)->format('d M Y') }}
            </td>

            <!-- Status -->
            <td class="px-6 py-4">
                <span class="px-2.5 py-1 
                    @if($aset->status === 'baru') bg-green-100 text-green-700
                    @elseif($aset->status === 'terpakai') bg-blue-100 text-blue-700
                    @else bg-gray-100 text-gray-700
                    @endif
                    text-xs font-medium rounded-full">
                    {{ ucfirst($aset->status) }}
                </span>
            </td>

            <!-- Aksi -->
            <td class="px-6 py-4">
                <div class="flex items-center justify-center gap-2">

                    <!-- Alokasikan -->
                    <a href="{{ route('manajemen-aset.alokasi', $aset->id) }}"
                       class="px-3 py-1.5 bg-blue-600 text-white text-xs rounded-lg hover:bg-blue-700">
                        <i class="fas fa-share-from-square"></i>
                    </a>

                    <!-- Detail -->
                    <a href="{{ route('manajemen-aset.show', $aset->id) }}"
                       class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                        <i class="fas fa-eye"></i>
                    </a>

                    <!-- Edit -->
                    <a href="{{ route('manajemen-aset.edit', $aset->id) }}"
                       class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg">
                        <i class="fas fa-edit"></i>
                    </a>

                    <!-- Hapus -->
                    <form action="{{ route('manajemen-aset.destroy', $aset->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin hapus aset {{ $aset->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>

                </div>
            </td>

        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center py-6 text-gray-500">
                Tidak ada aset baru
            </td>
        </tr>
    @endforelse
</tbody>
                        </table>
                    </div>
                </div>
            </section>
            
            <!-- Pagination -->
<section class="bg-white rounded-xl shadow-sm p-4">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">

        <!-- Info -->
        <p class="text-sm text-gray-500">
            Menampilkan
            <span class="font-medium text-gray-700">
                {{ $asetBaru->firstItem() }}
            </span>
            -
            <span class="font-medium text-gray-700">
                {{ $asetBaru->lastItem() }}
            </span>
            dari
            <span class="font-medium text-gray-700">
                {{ $asetBaru->total() }}
            </span>
            aset
        </p>

        <!-- Navigasi -->
        <div class="flex items-center gap-1">

            {{-- Previous --}}
            @if ($asetBaru->onFirstPage())
                <span class="px-3 py-1.5 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </span>
            @else
                <a href="{{ $asetBaru->previousPageUrl() }}"
                   class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($asetBaru->getUrlRange(1, $asetBaru->lastPage()) as $page => $url)
                @if ($page == $asetBaru->currentPage())
                    <span class="px-3 py-1.5 text-sm bg-gov-primary text-white rounded-lg">
                        {{ $page }}
                    </span>
                @elseif (
                    $page == 1 ||
                    $page == $asetBaru->lastPage() ||
                    abs($page - $asetBaru->currentPage()) <= 1
                )
                    <a href="{{ $url }}"
                       class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                        {{ $page }}
                    </a>
                @elseif ($page == 2 || $page == $asetBaru->lastPage() - 1)
                    <span class="px-2 text-gray-400">...</span>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($asetBaru->hasMorePages())
                <a href="{{ $asetBaru->nextPageUrl() }}"
                   class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <span class="px-3 py-1.5 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                    <i class="fas fa-chevron-right"></i>
                </span>
            @endif

        </div>
    </div>
</section>
        </main>
    <!-- JavaScript -->
    <script>
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
        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailModal();
                closeEditModal();
            }
        });
    </script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
</body>
</html>
