<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aset Terpakai - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
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

                <a href="{{ route('manajemen-aset.create') }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm">
                    + Tambah
                </a>
            </div>
        </div>
    </form>
</section>

            
            <!-- Grid View -->
<section id="gridView" class="hidden mb-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

        @forelse ($aset as $item)

        @php
    // Badge kondisi
    $conditionMap = [
        'baik' => ['bg-green-100 text-green-700', 'Baik'],
        'rusak_ringan' => ['bg-amber-100 text-amber-700', 'Rusak Ringan'],
        'rusak_berat' => ['bg-red-100 text-red-700', 'Rusak Berat'],
    ];

    [$badgeClass, $conditionText] =
        $conditionMap[$item->condition_code] ?? ['bg-gray-100 text-gray-700', 'Tidak Diketahui'];

    // Gradient background random
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
            <!-- Header -->
            <div class="h-32 bg-gradient-to-br {{ $gradient }} flex items-center justify-center relative">
                <span class="absolute top-3 right-3 px-2 py-1 {{ $badgeClass }} text-xs font-medium rounded-full">
                    {{ $conditionText }}
                </span>
            </div>

            <!-- Body -->
            <div class="p-4">
                <h4 class="font-semibold text-gray-800 mb-1 line-clamp-1">
                    {{ $item->name }}
                </h4>

                <p class="text-sm text-gray-500 mb-2">
                    {{ ucfirst(str_replace('-', ' ', $item->category_code)) }}
                </p>

                <!-- Info Status -->
                <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg mb-3">
                    <div class="min-w-0">
                        <p class="text-xs font-medium text-gray-700 truncate">
                            Status: {{ ucfirst($item->status) }}
                        </p>
                        <p class="text-xs text-gray-400 truncate">
                            Qty: {{ $item->quantity }}
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-between text-xs text-gray-400">
    <span>
        {{ \Carbon\Carbon::parse($item->purchase_date)->translatedFormat('d M Y') }}
    </span>

    <div class="flex items-center gap-1">
        <!-- Detail -->
        <a href="{{ route('manajemen-aset.show', $item->id) }}"
           class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
           title="Lihat Detail">
            <i class="fas fa-eye"></i>
        </a>

                        <!-- Edit -->
<a href="{{ route('manajemen-aset.edit', $item->id) }}"
   class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
   title="Edit">
    <i class="fas fa-edit"></i>
</a>

<!-- Hapus -->
<form action="{{ route('manajemen-aset.destroy', $item->id) }}"
      method="POST"
      onsubmit="return confirm('Yakin hapus {{ $item->name }}?')">
    @csrf
    @method('DELETE')
    <button type="submit"
        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
        title="Hapus">
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
            default => '-'
        };
    @endphp

    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $conditionColor }}">
        {{ $conditionLabel }}
    </span>
</td>

           {{-- Aksi --}}
<td class="px-6 py-4">
    <div class="flex items-center justify-center gap-1">

        {{-- Detail --}}
        <a href="{{ route('manajemen-aset.show', $item->id) }}"
           class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
            <i class="fas fa-eye"></i>
        </a>

        {{-- Edit --}}
        <a href="{{ route('manajemen-aset.edit', $item->id) }}"
           class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg"
           title="Edit">
            <i class="fas fa-edit"></i>
        </a>

        {{-- Hapus --}}
        <form action="{{ route('manajemen-aset.destroy', $item->id) }}"
              method="POST"
              onsubmit="return confirm('Yakin hapus aset {{ $item->name }}?')">
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
    <!-- JavaScript -->
    <script>
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
    </script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
</body>
</html>
