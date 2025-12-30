<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aset Baru - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
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
                    {{ $totalAsetBaru }}
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
            <a href="{{ route('admin.aset.create') }}"
               class="w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2
                      bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                <i class="fas fa-plus"></i>
                Tambah
            </a>
        </div>
    </div>
</section>

            
            <!-- Grid View (Hidden by default) -->
            <!-- Grid Aset Baru dari Database -->
<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

    @forelse ($asetBaru as $aset)
        <div class="bg-white rounded-xl shadow hover:shadow-md transition overflow-hidden">

            <!-- Header Card -->
            <div class="h-32 bg-blue-50 flex items-center justify-center relative">
                <i class="fas fa-box text-5xl text-blue-400"></i>

                <span class="absolute top-3 right-3 px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">
                    {{ ucfirst($aset->status) }}
                </span>
            </div>

            <!-- Body Card -->
            <div class="p-4">
                <h4 class="font-semibold text-gray-800 line-clamp-1">
                    {{ $aset->name }}
                </h4>

                <p class="text-sm text-gray-500">
                    {{ $aset->category_code }} • {{ $aset->location }}
                </p>

                <p class="text-xs text-gray-400">
                    SN: {{ $aset->serialnumber }}
                </p>

                <div class="flex justify-between items-center mt-3 text-xs text-gray-400">
                    <span>
                        <i class="fas fa-calendar-alt mr-1"></i>
                        {{ \Carbon\Carbon::parse($aset->purchase_date)->format('d M Y') }}
                    </span>
                    <span>Qty: {{ $aset->quantity }}</span>
                </div>
            </div>

        </div>
    @empty
        <p class="col-span-full text-center text-gray-500">
            Tidak ada aset baru
        </p>
    @endforelse

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
                    <a href="{{ route('admin.aset.alokasi', $aset->id) }}"
                       class="px-3 py-1.5 bg-blue-600 text-white text-xs rounded-lg hover:bg-blue-700">
                        <i class="fas fa-share-from-square"></i>
                    </a>

                    <!-- Detail -->
                    <a href="{{ route('admin.aset.show', $aset->id) }}"
                       class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                        <i class="fas fa-eye"></i>
                    </a>

                    <!-- Edit -->
                    <a href="{{ route('admin.aset.edit', $aset->id) }}"
                       class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg">
                        <i class="fas fa-edit"></i>
                    </a>

                    <!-- Hapus -->
                    <form action="{{ route('admin.aset.destroy', $aset->id) }}"
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
        
    </div>
    
    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden">
        <div id="detailBackdropDesktop" class="modal-backdrop absolute inset-0 bg-black/50 hidden lg:block" onclick="closeDetailModal()"></div>
        <div id="detailSheetDesktop" class="modal-sheet lg:modal-sheet-desktop hidden lg:block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full lg:max-w-2xl bg-white rounded-2xl shadow-xl lg:max-h-[90vh] overflow-y-auto">
            <div class="p-6 lg:p-8">
                <!-- Header -->
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Detail Aset Baru</h3>
                    <p id="modalName" class="text-lg font-semibold text-gray-700 mt-2">-</p>
                </div>
                
                <!-- Main Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 pb-6 border-b border-gray-200">
                    <!-- Kode SN -->
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wide mb-2">Kode SN</p>
                        <p id="modalSN" class="text-lg font-medium text-gray-800 font-mono bg-gray-50 px-3 py-2 rounded">-</p>
                    </div>
                    
                    <!-- Alamat -->
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wide mb-2">Alamat/Lokasi</p>
                        <p id="modalAlamat" class="text-lg font-medium text-gray-800">-</p>
                    </div>
                    
                    <!-- Kategori -->
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wide mb-2">Kategori</p>
                        <p id="modalCategory" class="text-lg font-medium text-gray-800">Jaringan</p>
                    </div>
                    
                    <!-- Kondisi -->
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wide mb-2">Kondisi</p>
                        <span id="modalConditionBadge" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-lg">
                            <span id="modalCondition">Baik</span>
                        </span>
                    </div>
                </div>
                
                <!-- Keterangan -->
                <div class="mb-6">
                    <h5 class="text-sm text-gray-500 font-semibold uppercase tracking-wide mb-3">Keterangan</h5>
                    <p class="text-gray-700 leading-relaxed">
                        Router core generasi terbaru untuk infrastruktur jaringan backbone. Sudah dilengkapi dengan lisensi Cisco SmartNet Extended. Kompatibel dengan semua protokol routing standar industri. Dalam kondisi baru dan belum digunakan.
                    </p>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center gap-3 pt-6 border-t border-gray-200">
                    <button onclick="openAllocationModal()" class="flex-1 flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                        Alokasikan Aset
                    </button>
                    <button onclick="closeDetailModal()" class="flex-1 flex items-center justify-center px-4 py-3 border border-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors">
                        Batal
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
                        <h3 class="text-xl font-bold text-gray-800">Detail Aset</h3>
                        <p id="modalNameMobile" class="text-base font-semibold text-gray-700 mt-1">-</p>
                    </div>
                    
                    <!-- Main Information -->
                    <div class="space-y-3 mb-5 pb-5 border-b border-gray-200">
                        <!-- Kode SN -->
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide mb-1">Kode SN</p>
                            <p id="modalSNMobile" class="font-medium text-gray-800 text-sm font-mono bg-gray-50 px-2 py-1 rounded">-</p>
                        </div>
                        
                        <!-- Alamat -->
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide mb-1">Alamat/Lokasi</p>
                            <p id="modalAlamatMobile" class="font-medium text-gray-800 text-sm">-</p>
                        </div>
                        
                        <!-- Kategori -->
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide mb-1">Kategori</p>
                            <p id="modalCategoryMobile" class="font-medium text-gray-800 text-sm">Jaringan</p>
                        </div>
                        
                        <!-- Kondisi -->
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide mb-1">Kondisi</p>
                            <p id="modalConditionMobile" class="font-medium text-gray-800 text-sm">Baik</p>
                        </div>
                    </div>
                    
                    <!-- Keterangan -->
                    <div class="mb-5">
                        <h5 class="text-xs text-gray-500 font-semibold uppercase tracking-wide mb-2">Keterangan</h5>
                        <p class="text-gray-700 text-sm leading-relaxed">
                            Router core generasi terbaru untuk infrastruktur jaringan backbone. Sudah dilengkapi dengan lisensi Cisco SmartNet Extended.
                        </p>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex flex-col gap-2 pt-4 border-t border-gray-200">
                        <button onclick="openAllocationModal()" class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                            Alokasikan Aset
                        </button>
                        <button onclick="closeDetailModal()" class="w-full flex items-center justify-center px-4 py-3 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-100 transition-colors">
                            Batal
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
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Edit Aset</h3>
                    <button onclick="closeEditModal()" class="lg:flex hidden p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <!-- Form -->
                <form onsubmit="handleEditSubmit(event)" class="space-y-6">
                    <!-- Nama Aset -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Aset</label>
                        <input type="text" id="editName" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                    </div>
                    
                    <!-- Kategori & SN (Grid) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                            <select id="editCategory" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Jaringan">Jaringan</option>
                                <option value="Penyimpanan">Penyimpanan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kode SN</label>
                            <input type="text" id="editSN" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>
                    </div>
                    
                    <!-- Alamat & Kondisi (Grid) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat/Lokasi</label>
                            <input type="text" id="editAlamat" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kondisi</label>
                            <select id="editCondition" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center gap-3 pt-6 border-t border-gray-200">
                        <button type="submit" class="flex-1 flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                            Simpan Perubahan
                        </button>
                        <button type="button" onclick="closeEditModal()" class="flex items-center justify-center px-4 py-3 border border-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors">
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
                    <!-- Header with Close Button -->
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Edit Aset</h3>
                        <button onclick="closeEditModal()" class="p-2 -mr-2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    
                    <!-- Form -->
                    <form onsubmit="handleEditSubmit(event)" class="space-y-4">
                        <!-- Nama Aset -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase">Nama Aset</label>
                            <input type="text" id="editNameMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>
                        
                        <!-- Kategori -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase">Kategori</label>
                            <select id="editCategoryMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Jaringan">Jaringan</option>
                                <option value="Penyimpanan">Penyimpanan</option>
                            </select>
                        </div>
                        
                        <!-- Kode SN -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase">Kode SN</label>
                            <input type="text" id="editSNMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>
                        
                        <!-- Alamat/Lokasi -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase">Alamat/Lokasi</label>
                            <input type="text" id="editAlamatMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>
                        
                        <!-- Kondisi -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase">Kondisi</label>
                            <select id="editConditionMobile" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex gap-2 pt-4 border-t border-gray-200">
                            <button type="submit" class="flex-1 flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                                Simpan
                            </button>
                            <button type="button" onclick="closeEditModal()" class="flex-1 flex items-center justify-center px-4 py-3 border border-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    
    <!-- JavaScript -->
    <script>
        // Global Asset Data
        const assetData = {
            1: {
                name: 'Laptop Dell Latitude 5520',
                sn: 'SN-DELL-LT-001',
                alamat: 'Ruang Admin, Lt. 2',
                category: 'Elektronik',
                condition: 'Baik',
                quantity: '1',
                date: '15 Jan 2024',
                allocationDate: '20 Jan 2024',
                notes: 'Aset dalam kondisi baik dan digunakan untuk keperluan operasional harian.'
            },
            2: {
                name: 'Monitor Samsung 27"',
                sn: 'SN-SAMSUNG-MON-002',
                alamat: 'Ruang Meeting, Lt. 1',
                category: 'Elektronik',
                condition: 'Baik',
                quantity: '1',
                date: '20 Feb 2024',
                allocationDate: '25 Feb 2024',
                notes: 'Monitor dalam kondisi sempurna, layar jernih tanpa cacat.'
            },
            3: {
                name: 'Printer HP LaserJet Pro',
                sn: 'SN-HP-PRINTER-003',
                alamat: 'Ruang Printer, Lt. 1',
                category: 'Elektronik',
                condition: 'Rusak Ringan',
                quantity: '1',
                date: '05 Mar 2023',
                allocationDate: '10 Mar 2023',
                notes: 'Printer masih berfungsi namun penggaris kertas perlu perbaikan.'
            }
        };
        
        // Check if mobile
        function isMobile() {
            return window.innerWidth < 1024;
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
            const data = assetData[id] || assetData[1];
            
            // Update Desktop Modal
            document.getElementById('modalName').textContent = data.name;
            document.getElementById('modalSN').textContent = data.sn;
            document.getElementById('modalAlamat').textContent = data.alamat;
            document.getElementById('modalCategory').textContent = data.category;
            document.getElementById('modalCondition').textContent = data.condition;
            
            // Update condition badge color based on condition
            const conditionBadge = document.getElementById('modalConditionBadge');
            if (data.condition === 'Baik') {
                conditionBadge.className = 'inline-flex items-center px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-lg';
            } else if (data.condition === 'Rusak Ringan') {
                conditionBadge.className = 'inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 text-sm font-medium rounded-lg';
            } else {
                conditionBadge.className = 'inline-flex items-center px-3 py-1 bg-red-100 text-red-700 text-sm font-medium rounded-lg';
            }
            
            // Update Mobile Modal
            document.getElementById('modalNameMobile').textContent = data.name;
            document.getElementById('modalSNMobile').textContent = data.sn;
            document.getElementById('modalAlamatMobile').textContent = data.alamat;
            document.getElementById('modalCategoryMobile').textContent = data.category;
            document.getElementById('modalConditionMobile').textContent = data.condition;
            
            if (isMobile()) {
                // Show mobile version
                const mobileSheet = document.getElementById('detailSheetMobile');
                mobileSheet.classList.remove('hidden');
                mobileSheet.classList.add('modal-mobile-visible');
                document.body.style.overflow = 'hidden';
            } else {
                // Show desktop version
                const desktopSheet = document.getElementById('detailSheetDesktop');
                desktopSheet.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
            
            detailModal.classList.remove('hidden');
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
            const detailModal = document.getElementById('detailModal');
            const editModal = document.getElementById('editModal');
            
            // Close detail modal first
            if (isMobile()) {
                const mobileDetail = document.getElementById('detailSheetMobile');
                mobileDetail.classList.remove('modal-mobile-visible');
                mobileDetail.classList.add('hidden');
            } else {
                const desktopDetail = document.getElementById('detailSheetDesktop');
                desktopDetail.classList.add('hidden');
            }
            
            if (isMobile()) {
                const mobileSheet = document.getElementById('editSheetMobile');
                mobileSheet.classList.remove('hidden');
                mobileSheet.classList.add('modal-mobile-visible');
            } else {
                const desktopSheet = document.getElementById('editSheetDesktop');
                desktopSheet.classList.remove('hidden');
            }
            
            editModal.classList.remove('hidden');
        }
        
        // Open Edit Modal Directly (tanpa detail modal)
        function openEditModalDirect(id) {
            const editModal = document.getElementById('editModal');
            
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
            document.getElementById('editCategory').value = data.category;
            document.getElementById('editCondition').value = data.condition;
            document.getElementById('editQuantity').value = data.quantity;
            document.getElementById('editAllocationDate').value = data.allocationDate;
            document.getElementById('editNotes').value = data.notes;
            
            // Mobile form
            document.getElementById('editNameMobile').value = data.name;
            document.getElementById('editCategoryMobile').value = data.category;
            document.getElementById('editConditionMobile').value = data.condition;
            document.getElementById('editNotesMobile').value = data.notes;
            
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
        
        function handleEditSubmit(event) {
            event.preventDefault();
            alert('Aset berhasil diperbarui!');
            closeEditModal();
        }

        // Allocation Modal Functions
        function openAllocationModal() {
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
            
            // Populate asset details from detail modal
            const name = document.getElementById('modalName').textContent;
            const sn = document.getElementById('modalSN').textContent;
            const category = document.getElementById('modalCategory').textContent;
            const condition = document.getElementById('modalCondition').textContent;
            
            // Desktop form
            document.getElementById('allocName').textContent = name;
            document.getElementById('allocSN').textContent = sn;
            document.getElementById('allocCategory').textContent = category;
            document.getElementById('allocCondition').textContent = condition;
            
            // Mobile form
            document.getElementById('allocNameMobile').textContent = name;
            document.getElementById('allocSNMobile').textContent = sn;
            document.getElementById('allocCategoryMobile').textContent = category;
            document.getElementById('allocConditionMobile').textContent = condition;
            
            // Set today's date as default
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('allocDate').value = today;
            document.getElementById('allocDateMobile').value = today;
        }
        
        // Open Allocation Modal Directly from Card (tanpa detail modal)
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
            const allocationDate = document.getElementById('allocDate')?.value || document.getElementById('allocDateMobile')?.value;
            const location = document.getElementById('allocLocation')?.value || document.getElementById('allocLocationMobile')?.value;
            const notes = document.getElementById('allocNotes')?.value || document.getElementById('allocNotesMobile')?.value;
            
            // Validasi form
            let errors = [];
            
            if (!allocationDate || allocationDate.trim() === '') {
                errors.push('Tanggal Alokasi harus diisi');
            }
            
            if (!location || location.trim() === '') {
                errors.push('Lokasi Penempatan harus diisi');
            }
            
            // Jika ada error, tampilkan error modal
            if (errors.length > 0) {
                showErrorModal(errors);
                return;
            }
            
            // Jika validasi berhasil, tampilkan confirmation modal
            showAllocationConfirmModal(allocationDate, location, notes);
        }
        
        function showErrorModal(errors) {
            const errorModal = document.createElement('div');
            errorModal.className = 'fixed inset-0 z-[9999] flex items-center justify-center';
            errorModal.innerHTML = `
                <div class="absolute inset-0 bg-black/50" onclick="this.parentElement.remove()"></div>
                <div class="relative bg-white rounded-2xl shadow-xl p-8 max-w-sm w-full mx-4 animate-in">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-red-600 text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 text-center mb-4">Validasi Form Gagal</h3>
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <ul class="space-y-2">
                            ${errors.map(error => `<li class="text-sm text-red-700 flex items-start gap-2"><i class="fas fa-times-circle mt-0.5 flex-shrink-0"></i><span>${error}</span></li>`).join('')}
                        </ul>
                    </div>
                    <button onclick="this.closest('.fixed').remove()" class="w-full px-4 py-2.5 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">
                        Kembali Ke Form
                    </button>
                </div>
            `;
            document.body.appendChild(errorModal);
        }
        
        function showAllocationConfirmModal(allocationDate, location, notes) {
            // Get asset details from the modal
            const assetName = document.getElementById('allocName')?.textContent || document.getElementById('allocNameMobile')?.textContent || '-';
            const assetSN = document.getElementById('allocSN')?.textContent || document.getElementById('allocSNMobile')?.textContent || '-';
            
            const confirmModal = document.createElement('div');
            confirmModal.className = 'fixed inset-0 z-[9999] flex items-center justify-center';
            confirmModal.innerHTML = `
                <div class="absolute inset-0 bg-black/50" onclick="this.parentElement.remove()"></div>
                <div class="relative bg-white rounded-2xl shadow-xl p-8 max-w-md w-full mx-4 animate-in">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-clipboard-check text-blue-600 text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 text-center mb-4">Konfirmasi Alokasi Aset</h3>
                    
                    <!-- Ringkasan Data -->
                    <div class="mb-6 space-y-3 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Nama Aset</p>
                            <p class="text-sm font-medium text-gray-800">${assetName}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Kode SN</p>
                            <p class="text-sm font-medium text-gray-800 font-mono">${assetSN}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Tanggal Alokasi</p>
                            <p class="text-sm font-medium text-gray-800">${new Date(allocationDate).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Lokasi Penempatan</p>
                            <p class="text-sm font-medium text-gray-800">${location}</p>
                        </div>
                        ${notes ? `<div>
                            <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Catatan</p>
                            <p class="text-sm font-medium text-gray-800">${notes}</p>
                        </div>` : ''}
                    </div>
                    
                    <p class="text-sm text-gray-600 text-center mb-6">Apakah Anda yakin ingin melanjutkan alokasi aset ini?</p>
                    
                    <div class="flex gap-3">
                        <button onclick="this.closest('.fixed').remove()" class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button onclick="processAllocation('${assetName}', '${allocationDate}', '${location}', '${notes}'); this.closest('.fixed').remove()" class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            Yakin, Alokasikan
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(confirmModal);
        }
        
        function processAllocation(assetName, allocationDate, location, notes) {
            // Log data
            console.log({
                assetName,
                allocationDate,
                location,
                notes: notes || '-'
            });
            
            // Tampilkan success modal
            const successModal = document.createElement('div');
            successModal.className = 'fixed inset-0 z-[9999] flex items-center justify-center';
            successModal.innerHTML = `
                <div class="absolute inset-0 bg-black/50" onclick="this.parentElement.remove()"></div>
                <div class="relative bg-white rounded-2xl shadow-xl p-8 max-w-sm w-full mx-4 animate-in">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Alokasi Berhasil</h3>
                    <p class="text-gray-600 text-center text-sm mb-6">Aset <strong>"${assetName}"</strong> telah berhasil dialokasikan.</p>
                    <button onclick="document.getElementById('allocationModal').classList.add('hidden'); this.closest('.fixed').remove(); location.reload();" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                        OK
                    </button>
                </div>
            `;
            document.body.appendChild(successModal);
            
            // Reset form
            document.getElementById('allocationForm')?.reset();
            document.getElementById('allocationFormMobile')?.reset();
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
                closeEditModal();
            }
    </script>
    
</body>
</html>
