<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aset Terpakai - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
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

            
            <section class="bg-white rounded-xl shadow-sm p-4 mb-6">
    <form method="GET" action="{{ route('manajemen-aset.index') }}">
        <div class="flex flex-col lg:flex-row gap-3 justify-between">

            <!-- FILTER -->
            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">

                <!-- Status -->
                <select name="status"
                    class="px-3 py-2 bg-gray-50 border rounded-lg text-sm"
                    onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="baru" {{ request('status')=='baru'?'selected':'' }}>Baru</option>
                    <option value="bekas" {{ request('status')=='bekas'?'selected':'' }}>Bekas</option>
                    <option value="terpakai" {{ request('status')=='terpakai'?'selected':'' }}>Terpakai</option>
                </select>

                <!-- Kategori -->
                <select name="category"
                    class="px-3 py-2 bg-gray-50 border rounded-lg text-sm"
                    onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="infrastruktur-pasif">Infrastruktur Pasif</option>
                    <option value="perangkat-aktif">Perangkat Aktif</option>
                    <option value="power">Power</option>
                    <option value="tools">Tools</option>
                </select>
            </div>

            <!-- SEARCH + TAMBAH -->
            <div class="flex gap-2 w-full lg:w-auto">
                <input type="text" name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari aset..."
                    class="px-3 py-2 bg-gray-50 border rounded-lg text-sm">

                <button class="px-4 py-2 bg-gov-primary text-white rounded-lg text-sm">
                    Cari
                </button>
            </div>
        </div>
    </form>
</section>

            
            <!-- Grid View -->
<section id="gridView" class="hidden mb-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

        @forelse ($aset as $item)

        @php
            $conditionMap = [
                'baik' => ['bg-green-100 text-green-700', 'Baik'],
                'rusak_ringan' => ['bg-amber-100 text-amber-700', 'Rusak Ringan'],
                'rusak_berat' => ['bg-red-100 text-red-700', 'Rusak Berat'],
            ];

            [$badgeClass, $conditionText] =
                $conditionMap[$item->condition_code] ?? ['bg-gray-100 text-gray-700', 'Tidak Diketahui'];

            $gradients = [
                'from-blue-50 to-blue-100',
                'from-purple-50 to-purple-100',
                'from-teal-50 to-teal-100',
                'from-indigo-50 to-indigo-100',
                'from-amber-50 to-amber-100',
                'from-rose-50 to-rose-100',
            ];
            $gradient = $gradients[$item->id % count($gradients)];
        @endphp

        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden group">
            <div class="h-32 bg-gradient-to-br {{ $gradient }} flex items-center justify-center relative">
                <span class="absolute top-3 right-3 px-2 py-1 {{ $badgeClass }} text-xs font-medium rounded-full">
                    {{ $conditionText }}
                </span>
            </div>

            <div class="p-4">
                <h4 class="font-semibold text-gray-800 mb-1 line-clamp-1">
                    {{ $item->name }}
                </h4>

                <p class="text-sm text-gray-500 mb-2">
                    {{ ucfirst(str_replace('_', ' ', $item->category_code)) }}
                </p>

                <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg mb-3">
                    <div>
                        <p class="text-xs font-medium text-gray-700">
                            Status: {{ ucfirst($item->status) }}
                        </p>
                        <p class="text-xs text-gray-400">
                            Qty: {{ $item->quantity }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs text-gray-400">
                    <span>
                        {{ \Carbon\Carbon::parse($item->purchase_date)->translatedFormat('d M Y') }}
                    </span>

                    <div class="flex items-center gap-1">
                        <a href="{{ route('manajemen-aset.show', $item->id) }}"
                           class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{ route('manajemen-aset.edit', $item->id) }}"
                           class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('manajemen-aset.destroy', $item->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin hapus {{ $item->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @empty
        <div class="col-span-full text-center text-gray-400 py-10">
            Tidak ada data aset
        </div>
        @endforelse

    </div>
</section>


            
            <!-- Table View -->
            <tbody class="divide-y divide-gray-100">
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
    @forelse ($aset as $index => $item)
        <tr class="hover:bg-gray-50 transition-colors">
            {{-- No --}}
            <td class="px-3 sm:px-6 py-4 text-center text-sm text-gray-600">
    {{ $aset->firstItem() + $index }}
</td>


            {{-- Nama Aset --}}
            <td class="px-3 sm:px-6 py-4">
                <span class="font-medium text-gray-800">
                    {{ $item->name }}
                </span>
            </td>

            {{-- Kategori --}}
            <td class="px-3 sm:px-6 py-4 text-sm text-gray-600">
                {{ $item->category_code }}
            </td>

            {{-- Kondisi --}}
            {{-- Kondisi --}}
<td class="px-3 sm:px-6 py-4">
    @php
        $conditionColor = match($item->condition_code) {
            'baik' => 'bg-green-100 text-green-700',
            'rusak_ringan' => 'bg-amber-100 text-amber-700',
            'rusak_berat' => 'bg-red-100 text-red-700',
            default => 'bg-gray-100 text-gray-600'
        };

        $conditionLabel = match($item->condition_code) {
            'baik' => 'Baik',
            'rusak_ringan' => 'Rusak Ringan',
            'rusak_berat' => 'Rusak Berat',
            default => ucfirst($item->condition_code)
        };
    @endphp

    <span class="px-3 py-1 text-xs font-medium rounded-full {{ $conditionColor }}">
        {{ $conditionLabel }}
    </span>
</td>


            {{-- Aksi --}}
            <td class="px-6 py-4">
                <div class="flex items-center justify-center gap-1">
                    <button
    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
    title="Lihat Detail"
    onclick="openDetailModal(this)"
    data-name="{{ $item->name }}"
    data-sn="{{ $item->serialnumber }}"
    data-location="{{ $item->location }}"
    data-category="{{ $item->category_code }}"
    data-condition="{{ $item->condition_code }}"
>
    <i class="fas fa-eye"></i>
</button>

                    <button onclick="openEditModalDirect" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>

                    <form action="{{ route('manajemen-aset.destroy', $item->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin hapus aset {{ $item->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg"
                            title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center py-6 text-gray-500">
                Data aset belum tersedia
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

        {{-- Info --}}
        <p class="text-sm text-gray-500">
            Menampilkan
            <span class="font-medium text-gray-700">
                {{ $aset->firstItem() }}
                -
                {{ $aset->lastItem() }}
            </span>
            dari
            <span class="font-medium text-gray-700">
                {{ number_format($aset->total()) }}
            </span>
            aset
        </p>

        {{-- Pagination Button --}}
        <div class="flex items-center gap-1">
            {{-- Previous --}}
            @if ($aset->onFirstPage())
                <button class="px-3 py-1.5 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
            @else
                <a href="{{ $aset->previousPageUrl() }}"
                   class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($aset->getUrlRange(1, $aset->lastPage()) as $page => $url)
                @if ($page == $aset->currentPage())
                    <span class="px-3 py-1.5 text-sm bg-gov-primary text-white rounded-lg">
                        {{ $page }}
                    </span>
                @elseif (
                    $page == 1 ||
                    $page == $aset->lastPage() ||
                    abs($page - $aset->currentPage()) <= 1
                )
                    <a href="{{ $url }}"
                       class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                        {{ $page }}
                    </a>
                @elseif ($page == 2 || $page == $aset->lastPage() - 1)
                    <span class="px-2 text-gray-400">...</span>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($aset->hasMorePages())
                <a href="{{ $aset->nextPageUrl() }}"
                   class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <button class="px-3 py-1.5 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed" disabled>
                    <i class="fas fa-chevron-right"></i>
                </button>
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
                        <button onclick="openEditModalDirect" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                                <i class="fas fa-edit"></i>
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
        <div class="absolute inset-0 bg-black/50" onclick="closeEditModal()"></div>
        <div id="editSheet" class="absolute bottom-0 left-0 right-0 lg:relative lg:top-1/2 lg:left-1/2 lg:-translate-x-1/2 lg:-translate-y-1/2 bg-white rounded-t-2xl lg:rounded-2xl shadow-xl w-full lg:max-w-2xl transform transition-transform duration-300 translate-y-full lg:translate-y-0">
            <div class="p-6 lg:p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Edit Data Aset</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
                </div>

                <form id="editForm" method="POST" action="">
                    @csrf @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Aset</label>
                            <input type="text" name="name" id="editName" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500/20 outline-none" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kategori</label>
                                <select name="category_code" id="editCategory" class="w-full px-4 py-2 border rounded-lg outline-none" required>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->code }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Serial Number</label>
                                <input type="text" name="serialnumber" id="editSN" class="w-full px-4 py-2 border rounded-lg font-mono outline-none" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Lokasi/Alamat</label>
                            <input type="text" name="location" id="editAlamat" class="w-full px-4 py-2 border rounded-lg outline-none" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kondisi</label>
                            <select name="condition_code" id="editCondition" class="w-full px-4 py-2 border rounded-lg outline-none" required>
                                @foreach($conditions as $con)
                                    <option value="{{ $con->code }}">{{ $con->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="status" value="terpakai">
                        <input type="hidden" name="quantity" value="1">
                    </div>

                    <div class="flex gap-3 mt-8 pt-6 border-t">
                        <button type="button" onclick="closeEditModal()" class="flex-1 px-4 py-2.5 border text-gray-700 rounded-lg font-semibold">Batal</button>
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script>
        // Open Edit Modal Directly (tanpa detail modal)
        function openEditModalDirect(id) {
            const editModal = document.getElementById('editModal');
            };
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

        function openDetailModal(button) {
            const modal = document.getElementById('detailModal');

            // Ambil data dari button
            const name = button.dataset.name;
            const sn = button.dataset.sn;
            const location = button.dataset.location;
            const category = button.dataset.category;
            const condition = button.dataset.condition;

            // Isi modal
            document.getElementById('modalName').innerText = name;
            document.getElementById('modalSN').innerText = sn;
            document.getElementById('modalAlamat').innerText = location;
            document.getElementById('modalCategory').innerText = category;

            const conditionBadge = document.getElementById('modalCondition');
            conditionBadge.innerText = condition;

            // Reset class
            conditionBadge.className = 'inline-flex px-2.5 py-1 text-xs font-medium rounded-full';

            // Warna kondisi
            if (condition === 'baik') {
                conditionBadge.classList.add('bg-green-100', 'text-green-700');
            } else if (condition === 'rusak ringan') {
                conditionBadge.classList.add('bg-amber-100', 'text-amber-700');
            } else if (condition === 'rusak berat') {
                conditionBadge.classList.add('bg-red-100', 'text-red-700');
            }

            // Tampilkan modal
            modal.classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
        
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
