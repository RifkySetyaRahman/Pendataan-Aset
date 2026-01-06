<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aset - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
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
                        <h1 class="text-lg font-semibold text-gray-800">Edit Aset</h1>
                        <p class="text-xs text-gray-500 hidden sm:block">Perbarui informasi aset yang ada</p>
                    </div>
                </div>
                
                <!-- Right: Actions -->
                <div class="flex items-center gap-2 sm:gap-4">
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <main class="p-4 lg:p-6">
            
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-xs text-gray-500 mb-6">
                <a href="{{ route('admin.manajemen-aset.index') }}" class="hover:text-blue-600">Aset</a>
                <i class="fas fa-chevron-right"></i>
                <span class="text-gray-700 font-medium">Edit Aset</span>
            </nav>

            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-edit text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Form Edit Aset</h2>
                            <p class="text-blue-100 text-sm mt-1">Ubah detail aset sesuai kebutuhan</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form id="editForm" action="{{ route('admin.manajemen-aset.update', $aset->id) }}" method="POST" class="p-6 lg:p-8">
                    @csrf
                    @method('PUT')
                    
                    <!-- Section 1: Data Dasar Aset -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-5 flex items-center gap-2">
                            <i class="fas fa-info-circle text-blue-600"></i>
                            Data Dasar Aset
                        </h3>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                            
                            <!-- Nama Aset -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-cube mr-2 text-blue-600"></i>
                                    Nama Aset <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="editNama" 
                                       name="name"
                                       value="{{ $aset->name }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800
                                              focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                              transition-colors"
                                       placeholder="Masukkan nama aset"
                                       required>
                                <p class="text-xs text-gray-500 mt-1">Nama unik untuk identifikasi aset</p>
                            </div>

                            <!-- Nomor Seri -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-barcode mr-2 text-blue-600"></i>
                                    Nomor Seri <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="editSN" 
                                       name="serialnumber"
                                       value="{{ $aset->serialnumber }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800
                                              focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                              transition-colors"
                                       placeholder="SN-XXXX-XXXXX"
                                       required>
                                <p class="text-xs text-gray-500 mt-1">Nomor seri dari aset</p>
                            </div>

                            <!-- Lokasi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-map-pin mr-2 text-blue-600"></i>
                                    Lokasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="editAlamat" 
                                       name="location"
                                       value="{{ $aset->location }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800
                                              focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                              transition-colors"
                                       placeholder="Gedung A, Lantai 2"
                                       required>
                                <p class="text-xs text-gray-500 mt-1">Lokasi penyimpanan aset</p>
                            </div>

                            <!-- Tanggal Perolehan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar mr-2 text-blue-600"></i>
                                    Tanggal Perolehan
                                </label>
                                <input type="date" 
                                       name="purchase_date"
                                       value="{{ $aset->purchase_date ? $aset->purchase_date->format('Y-m-d') : '' }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800
                                              focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                              transition-colors">
                                <p class="text-xs text-gray-500 mt-1">Tanggal aset diperoleh</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-8 border-gray-200">

                    <!-- Section 2: Klasifikasi & Kondisi -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-5 flex items-center gap-2">
                            <i class="fas fa-tag text-blue-600"></i>
                            Klasifikasi & Kondisi
                        </h3>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                            
                            <!-- Kategori -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-list mr-2 text-blue-600"></i>
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select id="editKategori" 
                                        name="category_code"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800
                                               focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                               transition-colors"
                                        required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->code }}"
                                                {{ $aset->category_code == $category->code ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Jenis/kategori aset</p>
                            </div>

                            <!-- Kondisi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-heartbeat mr-2 text-blue-600"></i>
                                    Kondisi <span class="text-red-500">*</span>
                                </label>
                                <select id="editKondisi" 
                                        name="condition_code"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800
                                               focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                               transition-colors"
                                        required>
                                    <option value="">-- Pilih Kondisi --</option>
                                    @foreach($conditions as $condition)
                                        <option value="{{ $condition->code }}"
                                                {{ $aset->condition_code == $condition->code ? 'selected' : '' }}>
                                            {{ $condition->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Kondisi fisik aset</p>
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-circle-info mr-2 text-blue-600"></i>
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800
                                               focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                               transition-colors"
                                        required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="baru" {{ $aset->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="terpakai" {{ $aset->status == 'terpakai' ? 'selected' : '' }}>Terpakai</option>
                                    <option value="bekas" {{ $aset->status == 'bekas' ? 'selected' : '' }}>Bekas</option>
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Status penggunaan aset</p>
                            </div>

                            <!-- Jumlah -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-box-open mr-2 text-blue-600"></i>
                                    Jumlah <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="quantity"
                                       value="{{ $aset->quantity }}"
                                       min="1"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800
                                              focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                              transition-colors"
                                       placeholder="1"
                                       required>
                                <p class="text-xs text-gray-500 mt-1">Jumlah unit aset</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-8 border-gray-200">

                    <!-- Section 3: Deskripsi -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-5 flex items-center gap-2">
                            <i class="fas fa-align-left text-blue-600"></i>
                            Deskripsi & Catatan
                        </h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-note-sticky mr-2 text-blue-600"></i>
                                Catatan
                            </label>
                            <textarea name="description"
                                      rows="4"
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800
                                             focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                                             transition-colors resize-none"
                                      placeholder="Tambahkan catatan atau deskripsi tentang aset...">{{ $aset->description }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Informasi tambahan tentang aset</p>
                        </div>
                    </div>

                    <hr class="my-8 border-gray-200">

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-end">
                        <a href="{{ route('admin.manajemen-aset.index') }}"
                           class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg font-medium
                                  hover:bg-gray-50 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-medium
                                       hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl shadow-xl max-w-sm w-full overflow-hidden animate-scale-up">
            <div class="bg-green-50 border-b border-green-200 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-green-900">Edit Berhasil!</h3>
                </div>
            </div>
            <div class="px-6 py-4 text-gray-700">
                <p>Data aset telah berhasil diperbarui.</p>
            </div>
            <div class="bg-gray-50 px-6 py-3 flex justify-end gap-2">
                <a href="{{ route('admin.manajemen-aset.index') }}"
                   class="px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition">
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl shadow-xl max-w-sm w-full overflow-hidden animate-scale-up">
            <div class="bg-red-50 border-b border-red-200 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation text-red-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-red-900">Validasi Gagal!</h3>
                </div>
            </div>
            <div class="px-6 py-4 text-gray-700">
                <p id="errorMessage">Mohon periksa kembali data yang Anda masukkan.</p>
            </div>
            <div class="bg-gray-50 px-6 py-3 flex justify-end gap-2">
                <button onclick="closeErrorModal()"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Check if mobile
        function isMobile() {
            return window.innerWidth < 1024;
        }

        // Toggle Sidebar
        // Close Error Modal
        function closeErrorModal() {
            document.getElementById('errorModal').classList.add('hidden');
        }

        // Handle Form Submit
        function handleFormSubmit(e) {
            e.preventDefault();

            const editNama = document.getElementById('editNama').value.trim();
            const editSN = document.getElementById('editSN').value.trim();
            const editAlamat = document.getElementById('editAlamat').value.trim();
            const editKategori = document.getElementById('editKategori').value;
            const editKondisi = document.getElementById('editKondisi').value;

            // Validate required fields
            if (!editNama || !editSN || !editAlamat || !editKategori || !editKondisi) {
                document.getElementById('errorMessage').textContent = 'Semua field yang ditandai (*) harus diisi!';
                document.getElementById('errorModal').classList.remove('hidden');
                return;
            }

            // If validation passes, submit the form
            document.getElementById('editForm').submit();
        }

        // Form submit event
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editForm');
            if (form) {
                form.addEventListener('submit', handleFormSubmit);
            }

            // Check for success message from session
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('success') === 'true') {
                document.getElementById('successModal').classList.remove('hidden');
                setTimeout(() => {
                    window.location.href = '{{ route("admin.manajemen-aset.index") }}';
                }, 2000);
            }
        });
    </script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
</body>
</html>
