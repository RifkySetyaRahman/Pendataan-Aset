<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Alokasi Aset - SIP-ASET</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 20px;
            padding-right: 40px;
        }
    </style>
</head>
<body class="bg-gray-100 font-inter">
     @include('components.sidebar-admin')
    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Header -->
        <header class="sticky top-0 z-30 bg-white shadow-sm">
            <div class="flex items-center justify-between px-4 py-3 lg:px-6">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <div>
                        <h1 class="text-lg font-semibold text-gray-800">Form Alokasi Aset</h1>
                        <p class="text-xs text-gray-500 hidden sm:block">Alokasikan aset ke pengguna atau departemen</p>
                    </div>
                </div>
            </div>
        </header>
        
        <main class="p-4 lg:p-6">
            <div class="bg-white rounded-xl shadow-sm p-6 lg:p-8">
                <form id="editForm" action="{{ route('admin.manajemen-aset.allocate') }}" method="POST" onsubmit="handleFormSubmit(event)">
                    
                    @csrf

                    <!-- Pilih Aset -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Aset <span class="text-red-500">*</span>
                        </label>
                            <select id="assetSelect"
        name="aset_id"
        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm bg-white"
        required>
    <option value="" disabled selected>Pilih nama aset</option>
    @foreach($daftarAset as $item)
        <option value="{{ $item->id }}"
            data-sn="{{ $item->serialnumber }}"
            data-location="{{ $item->location }}"
            data-category="{{ $item->category_code }}"
            data-condition="{{ $item->condition_code }}"
            data-status="{{ $item->status }}"
        >
            {{ $item->name }}
        </option>
    @endforeach
</select>
                        </div>

                    <!-- Detail Aset - Tampilan Readonly -->
                    <div class="mb-8 p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg border border-blue-300">
                        <div class="flex items-center gap-3 mb-6">
                            <i class="fas fa-box-open text-2xl text-blue-600"></i>
                            <h3 class="text-base font-semibold text-gray-800">Data Aset untuk Dialokasikan</h3>
                        </div>
                        
                        <!-- Kode SN -->
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-barcode text-blue-600 mr-2"></i>Kode SN
                            </label>
                            <div
     class="w-full px-4 py-3 border border-blue-300 rounded-lg text-sm bg-white text-gray-700 font-medium shadow-sm">
    -
</div>
                        </div>

                        <!-- Lokasi & Kategori -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-map-location-dot text-blue-600 mr-2"></i>Lokasi
                                </label>
                                <div class="w-full px-4 py-3 border border-blue-300 rounded-lg text-sm bg-white text-gray-700 font-medium shadow-sm">
                                    {{ $aset->location }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-folder-open text-blue-600 mr-2"></i>Kategori
                                </label>
                                <div class="w-full px-4 py-3 border border-blue-300 rounded-lg text-sm bg-white text-gray-700 font-medium shadow-sm">
                                    @foreach($categories as $cat)
                                        @if($cat->code == $aset->category_code)
                                            {{ $cat->name }}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Kondisi & Status -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-heart-pulse text-blue-600 mr-2"></i>Kondisi
                                </label>
                                <div class="w-full px-4 py-3 border border-blue-300 rounded-lg text-sm bg-white text-gray-700 font-medium shadow-sm">
                                    @foreach($conditions as $cond)
                                        @if($cond->code == $aset->condition_code)
                                            {{ $cond->name }}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-tag text-blue-600 mr-2"></i>Status
                                </label>
                                <div class="w-full px-4 py-3 border border-blue-300 rounded-lg text-sm bg-white text-gray-700 font-medium shadow-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($aset->status == 'baru') bg-green-100 text-green-800
                                        @elseif($aset->status == 'bekas') bg-yellow-100 text-yellow-800
                                        @else bg-blue-100 text-blue-800
                                        @endif">
                                        {{ ucfirst($aset->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row items-center gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.manajemen-aset.index') }}" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 border border-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                        <button type="submit" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                            <i class="fas fa-check"></i>
                            Alokasikan Aset
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    
    <!-- Modal Success -->
    <div id="modalSuccess" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-3xl text-green-600"></i>
                </div>
            </div>
            <h2 class="text-lg font-semibold text-center text-gray-800 mb-2">Alokasi Berhasil!</h2>
            <p class="text-center text-gray-600 text-sm mb-6">Aset telah berhasil dialokasikan ke pengguna</p>
            <button onclick="closeSuccess()" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-semibold text-sm">
                Tutup
            </button>
        </div>
    </div>
    
    <!-- Modal Error -->
    <div id="modalError" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation text-3xl text-red-600"></i>
                </div>
            </div>
            <h2 class="text-lg font-semibold text-center text-gray-800 mb-2">Validasi Gagal</h2>
            <p class="text-center text-gray-600 text-sm mb-6" id="errorMessage">Terjadi kesalahan</p>
            <button onclick="closeError()" class="w-full px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-semibold text-sm">
                Tutup
            </button>
        </div>
    </div>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.toggle('hidden');
        }
        
        function toggleSubmenu(button) {
            const container = button.closest('.submenu-container');
            const submenu = container.querySelector('.submenu');
            const chevron = button.querySelector('.fa-chevron-down');
            
            submenu.classList.toggle('open');
            chevron.classList.toggle('rotate-180');
        }
        
        function updateAssetDetails() {
            // Tidak diperlukan lagi karena data langsung dari server
            return;
        }
        
        function handleFormSubmit(event) {
            event.preventDefault();
            
            const userSelect = document.getElementById('userSelect').value;
            const departmentSelect = document.getElementById('departmentSelect').value;
            const divisionInput = document.getElementById('divisionInput').value;
            const allocationDate = document.getElementById('allocationDate').value;
            
            if (!userSelect) {
                showError('Mohon pilih pengguna terlebih dahulu');
                return;
            }
            
            if (!departmentSelect) {
                showError('Mohon pilih departemen terlebih dahulu');
                return;
            }
            
            if (!divisionInput) {
                showError('Mohon isi nama divisi');
                return;
            }
            
            if (!allocationDate) {
                showError('Mohon pilih tanggal alokasi');
                return;
            }
            
            // Submit form jika validasi berhasil
            document.getElementById('editForm').submit();
        }
        
        function showSuccess() {
            document.getElementById('modalSuccess').classList.remove('hidden');
        }
        
        function closeSuccess() {
            document.getElementById('modalSuccess').classList.add('hidden');
            window.location.href = '{{ route("admin.manajemen-aset.index") }}';
        }
        
        function showError(message) {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('modalError').classList.remove('hidden');
        }

document.getElementById('assetSelect').addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];

    document.getElementById('snText').innerText = selected.dataset.sn;
    document.getElementById('locationText').innerText = selected.dataset.location;
});
        
        function closeError() {
            document.getElementById('modalError').classList.add('hidden');
        }
        
        // Set today's date as default untuk tanggal alokasi
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('allocationDate').value = today;
        });
    </script>
</body>
</html>
