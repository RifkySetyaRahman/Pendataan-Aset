<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aset Baru - SIP-ASET</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .step-content { display: none; }
        .step-content.active { display: block; }
        .submenu { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; }
        .submenu.open { max-height: 500px; }
    </style>
</head>
<body class="bg-gray-100 font-inter">
    
    @include('components.sidebar-admin')
    
    <div id="modalSuccess" class="{{ session('success') ? 'flex' : 'hidden' }} fixed inset-0 bg-black/50 z-50 items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check text-3xl text-green-600"></i>
            </div>
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Berhasil!</h2>
            <p class="text-gray-600 mb-6">{{ session('success') }}</p>
            <button onclick="window.location.href='{{ route('manajemen-aset.aset-baru') }}'" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg font-medium">OK</button>
        </div>
    </div>

    <div class="lg:ml-64 min-h-screen">
        <header class="bg-white shadow-sm sticky top-0 z-30 flex items-center justify-between px-6 py-4">
            <h1 class="text-lg font-semibold text-gray-800">Tambah Aset Baru</h1>
            <a href="{{ route('manajemen-aset.aset-baru') }}" class="text-sm text-gray-600 hover:text-blue-600">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </header>
        
        <main class="p-4 sm:p-6 lg:p-8">
            <div class="max-w-3xl mx-auto">
                <div class="mb-8 bg-white rounded-lg shadow-sm p-4 text-center">
                    <p class="text-sm font-medium text-gray-600 mb-2">Step <span id="currentStepText">1</span> dari 2</p>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div id="progressBar" class="bg-blue-600 h-2 rounded-full transition-all duration-500" style="width: 50%"></div>
                    </div>
                </div>
                
                <form id="assetForm" method="POST" action="{{ route('manajemen-aset.store') }}" class="bg-white rounded-lg shadow-sm p-6">
                    @csrf
                    <input type="hidden" name="location" value="Gudang">

                    <div id="step1" class="step-content active">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6 border-b pb-2">Identitas Aset</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Aset *</label>
                                <input type="text" name="name" id="namaAset" class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500/20 outline-none" placeholder="Contoh: Laptop Dell" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Serial Number *</label>
                                <input type="text" name="serialnumber" id="kodeSN" class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500/20 outline-none" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                                <select name="category_code" id="kategori" class="w-full px-4 py-2.5 border rounded-lg bg-white" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->code }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="step2" class="step-content">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6 border-b pb-2">Detail & Kondisi</h2>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi *</label>
                                    <select name="condition_code" id="kondisi" class="w-full px-4 py-2.5 border rounded-lg bg-white" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($conditions as $cond)
                                            <option value="{{ $cond->code }}">{{ $cond->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                                    <select name="status" class="w-full px-4 py-2.5 border rounded-lg bg-white" required>
                                        <option value="baru">Baru</option>
                                        <option value="bekas">Bekas</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Perolehan</label>
                                <input type="date" name="purchase_date" id="tanggalPerolehan" class="w-full px-4 py-2.5 border rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                <input type="number" name="quantity" min="1" value="1" class="w-full px-4 py-2.5 border rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                <textarea name="description" rows="3" class="w-full px-4 py-2.5 border rounded-lg" placeholder="Opsional"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 justify-end mt-8 pt-6 border-t">
                        <button type="button" id="btnSebelumnya" onclick="changeStep(-1)" class="hidden px-6 py-2.5 border rounded-lg">Sebelumnya</button>
                        <button type="button" id="btnSelanjutnya" onclick="validateAndNext()" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg">Selanjutnya</button>
                        <button type="submit" id="btnSimpan" class="hidden px-6 py-2.5 bg-green-600 text-white rounded-lg">Simpan Aset</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <div id="modalError" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full text-center">
            <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
            <p id="errorMessage" class="text-gray-700 mb-6"></p>
            <button onclick="document.getElementById('modalError').classList.add('hidden')" class="w-full py-2 bg-red-500 text-white rounded-lg">Tutup</button>
        </div>
    </div>

    <script>
        
        let step = 1;

        function validateAndNext() {
            if (step === 1) {
                const name = document.getElementById('namaAset').value;
                const sn = document.getElementById('kodeSN').value;
                const cat = document.getElementById('kategori').value;

                if (!name || !sn || !cat) {
                    document.getElementById('errorMessage').textContent = 'Mohon lengkapi Identitas Aset!';
                    document.getElementById('modalError').classList.remove('hidden');
                    return;
                }
                changeStep(1);
            }
        }

        function changeStep(delta) {
            step += delta;
            
            // UI Toggle
            document.querySelectorAll('.step-content').forEach((el, i) => {
                el.classList.toggle('active', i + 1 === step);
            });

            // Progress Bar
            document.getElementById('progressBar').style.width = (step / 2 * 100) + '%';
            document.getElementById('currentStepText').textContent = step;

            // Button Toggle
            document.getElementById('btnSebelumnya').classList.toggle('hidden', step === 1);
            document.getElementById('btnSelanjutnya').classList.toggle('hidden', step === 2);
            document.getElementById('btnSimpan').classList.toggle('hidden', step === 1);
        }

        // Set Default Date
        document.getElementById('tanggalPerolehan').value = new Date().toISOString().split('T')[0];
    </script>
</body>
</html>