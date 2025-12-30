<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aset Baru - SIP-ASET</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style-admin.css">
    <style>
        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }
    </style>
</head>
<body class="bg-gray-100 font-inter">
    
    @include('components.sidebar-admin')
    
    <!-- Modal Success -->
    <div id="modalSuccess" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 animate-in">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-3xl text-green-600"></i>
                </div>
            </div>
            <h2 class="text-xl font-semibold text-center text-gray-800 mb-2">Berhasil!</h2>
            <p class="text-center text-gray-600 mb-6">Aset berhasil ditambahkan ke sistem</p>
            <button onclick="redirectToDashboard()" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">
                Kembali ke Dashboard
            </button>
        </div>
    </div>
    
    <!-- Modal Error/Validation -->
    <div id="modalError" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 animate-in">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation text-3xl text-red-600"></i>
                </div>
            </div>
            <h2 class="text-xl font-semibold text-center text-gray-800 mb-2">Perhatian</h2>
            <p class="text-center text-gray-600 mb-6" id="errorMessage">Mohon isi semua field yang diperlukan</p>
            <button onclick="closeErrorModal()" class="w-full px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                Tutup
            </button>
        </div>
    </div>

    <!-- Main -->
    <div class="lg:ml-64">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-30">
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center gap-3">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 text-gray-600 hover:bg-gray-100 rounded">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-lg font-semibold text-gray-800">Tambah Aset Baru</h1>
                </div>
                <a href="dashboard-admin.html" class="text-sm text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </header>
        
        <!-- Content -->
        <main class="p-4 sm:p-6 lg:p-8">
            <div class="max-w-3xl mx-auto">
                <!-- Step Indicator -->
                <div class="mb-8 bg-white rounded-lg shadow-sm p-4">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-medium text-gray-600">Step <span id="currentStep">1</span> dari 2</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div id="progressBar" class="bg-blue-600 h-2 rounded-full transition-all" style="width: 50%"></div>
                    </div>
                </div>
                
                <!-- Form -->
                <form 
    method="POST" 
    action="{{ route('admin.aset.store') }}" 
    class="bg-white rounded-lg shadow-sm p-6"
>
    @csrf

                    <!-- Step 1 -->
                    <div id="step1" class="step-content">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Identitas Aset</h2>
                        
                        <!-- Nama Aset -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Aset <span class="text-red-500">*</span></label>
                            <input
    type="text"
    name="name"
    required
    class="w-full px-4 py-2.5 border rounded-lg"
    placeholder="Contoh: Laptop ASUS VivoBook 14"
>
                            <p class="text-xs text-gray-400 mt-1">Masukkan nama lengkap aset beserta merk jika ada</p>
                        </div>
                        
                        <!-- Kode SN (Serial Number) -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode SN / Serial Number <span class="text-red-500">*</span></label>
                            <input
    type="text"
    name="serialnumber"
    required
    class="w-full px-4 py-2.5 border rounded-lg"
    placeholder="SN123456789"
>

                            <p class="text-xs text-gray-400 mt-1">Masukkan nomor seri atau kode identitas aset</p>
                        </div>
                        
                        <!-- Alamat/Lokasi -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat / Lokasi Penempatan <span class="text-red-500">*</span></label>
                            <input
    type="text"
    name="location"
    required
    class="w-full px-4 py-2.5 border rounded-lg"
    placeholder="Ruang Kepala Dinas, Lt. 2"
>

                            <p class="text-xs text-gray-400 mt-1">Masukkan alamat atau lokasi penempatan aset</p>
                        </div>
                        
                        <!-- Tanggal Perolehan -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Perolehan</label>
                            <input
    type="date"
    name="purchase_date"
    class="w-full px-4 py-2.5 border rounded-lg"
>

                            <p class="text-xs text-gray-400 mt-1">Tanggal aset diterima atau dibeli</p>
                        </div>

                        <!-- Kategori -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                            <select name="category_code" required class="w-full px-4 py-2.5 border rounded-lg bg-white">
    <option value="">-- Pilih Kategori --</option>
    @foreach ($categories as $category)
        <option 
            value="{{ $category->code }}"
            @selected(old('category_code') == $category->code)
        >
            {{ $category->name }}
        </option>
    @endforeach
</select>

                            <p class="text-xs text-gray-400 mt-1">Pilih kategori aset sesuai dengan jenisnya</p>
                        </div>
                        
                        <!-- Kondisi -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi <span class="text-red-500">*</span></label>
                            <select name="condition_code" required class="w-full px-4 py-2.5 border rounded-lg bg-white">
    <option value="">-- Pilih Kondisi --</option>
    @foreach ($conditions as $condition)
        <option 
            value="{{ $condition->code }}"
            @selected(old('condition_code') == $condition->code)
        >
            {{ $condition->name }}
        </option>
    @endforeach
</select>

                            <p class="text-xs text-gray-400 mt-1">Pilih kondisi aset saat ini</p>
                        </div>
                    </div>
                    
                    <!-- Deskripsi -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea
    name="description"
    rows="4"
    class="w-full px-4 py-2.5 border rounded-lg resize-none"
>{{ old('description') }}</textarea>

                            <p class="text-xs text-gray-400 mt-1">Deskripsi Barang</p>
                        </div>
                    </div>
                        
                        <!-- Status -->
                        <div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Status Aset <span class="text-red-500">*</span>
    </label>
    <select
        name="status"
        required
        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg
               focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white"
    >
        <option value="baru" selected>Baru</option>
        <option value="bekas">Bekas</option>
    </select>
    <p class="text-xs text-gray-400 mt-1">
        Pilih status fisik aset saat didaftarkan
    </p>
</div>

                        <!-- Jumlah -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                            <input type="number" name="quantity"
    min="1"
    value="1"
    required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        </div>
                        
                    
                    <!-- Buttons -->
                    <div class="flex gap-3 justify-end mt-8 pt-6 border-t border-gray-200">
                        <a href="dashboard-admin.html" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                            Batal
                        </a>
                        <button type="button" id="btnSebelumnya" onclick="previousStep()" class="hidden px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                            <i class="fas fa-arrow-left mr-2"></i>Sebelumnya
                        </button>
                        <button type="button" id="btnSelanjutnya" onclick="nextStep()" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                        <button type="submit" id="btnSimpan" class="hidden px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">
                            <i class="fas fa-check mr-2"></i>Simpan Aset
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    
    <script>
        let currentStep = 1;
        
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
        
        function showErrorModal(message) {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('modalError').classList.remove('hidden');
        }
        
        function closeErrorModal() {
            document.getElementById('modalError').classList.add('hidden');
        }
        
        function showSuccessModal() {
            document.getElementById('modalSuccess').classList.remove('hidden');
        }
        
        function redirectToDashboard() {
            window.location.href = 'dashboard-admin.html';
        }
        
        function nextStep() {
            if (currentStep === 1) {
                const nama = document.getElementById('namaAset').value.trim();
                const kodeSN = document.getElementById('kodeSN').value.trim();
                const alamat = document.getElementById('alamat').value.trim();
                const kategori = document.getElementById('kategori').value;
                const kondisi = document.getElementById('kondisi').value;
                
                if (!nama || !kodeSN || !alamat || !kategori || !kondisi) {
                    showErrorModal('Mohon isi semua field yang diperlukan');
                    return;
                }
                
                if (nama.length < 3) {
                    showErrorModal('Nama aset minimal 3 karakter');
                    return;
                }
                
                if (kodeSN.length < 3) {
                    showErrorModal('Kode SN minimal 3 karakter');
                    return;
                }
                
                if (alamat.length < 5) {
                    showErrorModal('Alamat minimal 5 karakter');
                    return;
                }
            }
            
            if (currentStep < 2) {
                currentStep++;
                updateUI();
            }
        }
        
        function previousStep() {
            if (currentStep > 1) {
                currentStep--;
                updateUI();
            }
        }
        
        function updateUI() {
            document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
            document.getElementById('step' + currentStep).classList.remove('hidden');
            
            document.getElementById('progressBar').style.width = (currentStep / 2 * 100) + '%';
            document.getElementById('currentStep').textContent = currentStep;
            
            if (currentStep === 1) {
                document.getElementById('btnSebelumnya').classList.add('hidden');
                document.getElementById('btnSelanjutnya').classList.remove('hidden');
                document.getElementById('btnSimpan').classList.add('hidden');
            } else {
                document.getElementById('btnSebelumnya').classList.remove('hidden');
                document.getElementById('btnSelanjutnya').classList.add('hidden');
                document.getElementById('btnSimpan').classList.remove('hidden');
            }
        }
        
        function handleFormKeypress(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                
                if (currentStep === 1) {
                    nextStep();
                } else if (currentStep === 2) {
                    document.getElementById('assetForm').dispatchEvent(new Event('submit'));
                }
                return false;
            }
            return true;
        }
        
        document.getElementById('assetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nama = document.getElementById('namaAset').value.trim();
            const kodeSN = document.getElementById('kodeSN').value.trim();
            const alamat = document.getElementById('alamat').value.trim();
            const kategori = document.getElementById('kategori').value;
            const kondisi = document.getElementById('kondisi').value;
            
            // Final validation
            if (!nama || !kodeSN || !alamat || !kategori || !kondisi) {
                showErrorModal('Mohon isi semua field yang diperlukan');
                return;
            }
            
            showSuccessModal();
        });
        
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggalPerolehan').value = today;
        
    </script>
    
</body>
</html>
