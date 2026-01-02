<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna - SIP-ASET</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-admin.css') }}">
    <style>
        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }
        
        .modal-hidden {
            display: none !important;
            pointer-events: none !important;
        }
        
        .modal-visible {
            display: flex !important;
            pointer-events: auto !important;
        }
    </style>

</head>
<body class="bg-gray-100 font-inter">
    
    @include('components.sidebar-admin')
    
    <!-- Modal Success -->
    <div id="modalSuccess" class="fixed inset-0 bg-black/50 z-50 hidden modal-hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 animate-in">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-3xl text-green-600"></i>
                </div>
            </div>
            <h2 class="text-xl font-semibold text-center text-gray-800 mb-2">Berhasil!</h2>
            <p class="text-center text-gray-600 mb-6">Pengguna baru berhasil ditambahkan ke sistem</p>
            <button onclick="redirectToManagemen()" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">
                Kembali ke Manajemen User
            </button>
        </div>
    </div>
    
    <!-- Modal Warning - Field Belum Lengkap -->
    <div id="modalWarning" class="fixed inset-0 bg-black/50 z-50 hidden modal-hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 animate-in">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-3xl text-yellow-600"></i>
                </div>
            </div>
            <h2 class="text-xl font-semibold text-center text-gray-800 mb-2">Form Belum Lengkap</h2>
            <p class="text-center text-gray-600 text-sm mb-4">Field berikut belum diisi:</p>
            
            <!-- Missing Fields List -->
            <div class="bg-yellow-50 rounded-lg p-4 mb-6 space-y-2 border border-yellow-200">
                <div id="missingFieldsList" class="space-y-2">
                    <!-- Fields akan ditampilkan di sini via JavaScript -->
                </div>
            </div>
            
            <button onclick="closeWarningModal()" class="w-full px-4 py-2.5 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali & Lengkapi
            </button>
        </div>
    </div>
    
    <!-- Modal Error/Validation -->
    <div id="modalError" class="fixed inset-0 bg-black/50 z-50 hidden modal-hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 animate-in">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation text-3xl text-red-600"></i>
                </div>
            </div>
            <h2 class="text-xl font-semibold text-center text-gray-800 mb-2">Error</h2>
            <p class="text-center text-gray-600 mb-6" id="errorMessage">Mohon isi semua field yang diperlukan</p>
            <button onclick="closeErrorModal()" class="w-full px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                Tutup
            </button>
        </div>
    </div>
    
    <!-- Modal Konfirmasi - Form Lengkap -->
    <div id="modalConfirm" class="fixed inset-0 bg-black/50 z-50 hidden modal-hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 animate-in">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-3xl text-blue-600"></i>
                </div>
            </div>
            <h2 class="text-xl font-semibold text-center text-gray-800 mb-2">Konfirmasi Tambah Pengguna</h2>
            <p class="text-center text-gray-600 text-sm mb-6">Pastikan data berikut sudah benar sebelum ditambahkan</p>
            
            <!-- Data Preview -->
            <div class="bg-gray-50 rounded-lg p-4 mb-6 space-y-3">
                <div class="flex items-start gap-3">
                    <i class="fas fa-user text-blue-600 mt-1 w-4"></i>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 font-medium">Nama Lengkap</p>
                        <p class="text-sm font-semibold text-gray-800" id="confirmNama">-</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <i class="fas fa-envelope text-blue-600 mt-1 w-4"></i>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 font-medium">Email</p>
                        <p class="text-sm font-semibold text-gray-800" id="confirmEmail">-</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <i class="fas fa-briefcase text-blue-600 mt-1 w-4"></i>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 font-medium">Role</p>
                        <p class="text-sm font-semibold text-gray-800" id="confirmRole">-</p>
                    </div>
                </div>
                </div>
                <div class="flex items-start gap-3">
                    <i class="fas fa-briefcase text-blue-600 mt-1 w-4"></i>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 font-medium">Status</p>
                        <p class="text-sm font-semibold text-gray-800" id="confirmRole">-</p>
                    </div>
                </div>
            </div>
            
            <div class="flex gap-3">
                <button onclick="closeConfirmModal()" class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Batal
                </button>
                <button onclick="submitFormConfirmed()" class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    <i class="fas fa-check mr-2"></i>Yakin, Tambahkan
                </button>
            </div>
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
                    <h1 class="text-lg font-semibold text-gray-800">Tambah Pengguna Baru</h1>
                </div>
                <a href="manajemenuser.html" class="text-sm text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </header>

        <!-- Content -->
        <main class="p-4 sm:p-6 lg:p-8 flex-1">
            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8 lg:p-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-8">Informasi Pengguna</h2>
                <form action="{{ route('users.store') }}" method="POST"class="grid grid-cols-1 md:grid-cols-2 gap-6"> @csrf
                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2">
                        <label for="namaLengkap" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user text-gray-400 mr-2"></i>Nama Lengkap
                            <span class="text-red-500">*</span>
                        </label>
                        <input
    type="text"
    name="name"
    value="{{ old('name') }}"
    class="w-full px-4 py-2.5 border rounded-lg
           @error('name') border-red-500 @else border-gray-300 @enderror">

@error('name')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror

                    </div>

                    <!-- Username -->
                    <div class="md:col-span-2">
                        <label for="namaLengkap" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user text-gray-400 mr-2"></i>Username
                            <span class="text-red-500">*</span>
                        </label>
                        <input
    type="text"
    name="username"
    value="{{ old('username') }}"
    class="w-full px-4 py-2.5 border rounded-lg
           @error('username') border-red-500 @enderror">

@error('username')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror

                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope text-gray-400 mr-2"></i>Email
                            <span class="text-red-500">*</span>
                        </label>
                        <input
    type="email"
    name="email"
    value="{{ old('email') }}"
    class="w-full px-4 py-2.5 border rounded-lg
           @error('email') border-red-500 @enderror">

@error('email')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror

                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-briefcase text-gray-400 mr-2"></i>Role
                            <span class="text-red-500">*</span>
                        </label>
                            <select name="role" class="w-full px-4 py-2.5 border rounded-lg
    @error('role') border-red-500 @enderror">
    <option value="">-- Pilih Role --</option>
    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
    <option value="pegawai" {{ old('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
</select>

@error('role')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror

                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-briefcase text-gray-400 mr-2"></i>Status
                        <select name="status" required class="w-full px-4 py-2.5 border rounded-lg">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock text-gray-400 mr-2"></i>Password
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input
    type="password"
    name="password"
    class="w-full px-4 py-2.5 border rounded-lg
           @error('password') border-red-500 @enderror">



                            <button 
                                type="button" 
                                onclick="togglePasswordVisibility('password')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                            >
                                <i class="fas fa-eye"></i>
                            </button>
                            @error('password')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label for="konfirmPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock text-gray-400 mr-2"></i>Konfirmasi Password
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input
    type="password"
    name="password_confirmation"
    class="w-full px-4 py-2.5 border rounded-lg">

                            <button
                                type="submit"
                                onclick="togglePasswordVisibility('konfirmPassword')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                            >
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="md:col-span-2 flex gap-4 pt-6 border-t border-gray-200">
                        <button 
                            type="button" 
                            onclick="kembaliKeManajemen()"
                            class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium flex items-center justify-center gap-2"
                        >
                            <i class="fas fa-times"></i> Batalkan
                        </button>
                        <button 
                            type="submit" 
                            class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium flex items-center justify-center gap-2"
                        >
                            <i class="fas fa-save"></i> Tambah Pengguna
                        </button>
                    </div>
                    @if (session('success'))
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
        <i class="fas fa-check-circle mr-1"></i>
        {{ session('success') }}
    </div>
@endif

                </form>
            </div>
        </main>
    </div>

    <script>
        // Initialize form on page load
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('addUserForm');
            if (form) {
                form.reset();
                document.getElementById('namaLengkap').value = '';
                document.getElementById('email').value = '';
                document.getElementById('role').value = '';
                document.getElementById('password').value = '';
                document.getElementById('konfirmPassword').value = '';
            }
        });

        // Sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Submenu toggle
        function toggleSubmenu(button) {
            const container = button.closest('.submenu-container');
            const submenu = container.querySelector('.submenu');
            const chevron = button.querySelector('.fa-chevron-down');
            
            submenu.classList.toggle('open');
            chevron.classList.toggle('rotate-180');
        }

        // Toggle password visibility
        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            const isPassword = field.type === 'password';
            field.type = isPassword ? 'text' : 'password';
        }

        // Form submission
        function submitForm(event) {
            event.preventDefault();
            
            try {
                const form = document.getElementById('addUserForm');
                const formData = new FormData(form);
                
                // Get all field values
                const namaLengkap = (formData.get('nama_lengkap') || '').trim();
                const email = (formData.get('email') || '').trim();
                const role = (formData.get('role') || '').trim();
                const password = formData.get('password') || '';
                const konfirmPassword = formData.get('konfirm_password') || '';
                
                // Check which fields are missing
                const missingFields = [];
                
                if (!namaLengkap) {
                    missingFields.push('Nama Lengkap');
                }
                if (!email) {
                    missingFields.push('Email');
                }
                if (!role) {
                    missingFields.push('Role');
                }
                if (!password) {
                    missingFields.push('Password');
                }
                if (!konfirmPassword) {
                    missingFields.push('Konfirmasi Password');
                }
                
                // Show warning if there are missing fields
                if (missingFields.length > 0) {
                    showWarningModal(missingFields);
                    return;
                }
                
                // Validate passwords match
                if (password !== konfirmPassword) {
                    showErrorModal('Password dan Konfirmasi Password tidak cocok');
                    return;
                }
                
                // Validate minimum length
                if (namaLengkap.length < 3) {
                    showErrorModal('Nama Lengkap minimal 3 karakter');
                    return;
                }
                
                if (password.length < 6) {
                    showErrorModal('Password minimal 6 karakter');
                    return;
                }
                
                // All validations passed, show confirmation modal
                showConfirmModal(namaLengkap, email, role);
            } catch (error) {
                console.error('Error in submitForm:', error);
                showErrorModal('Terjadi kesalahan: ' + error.message);
            }
        }

        // Show warning modal with missing fields
        function showWarningModal(missingFields) {
            try {
                const fieldsList = document.getElementById('missingFieldsList');
                fieldsList.innerHTML = '';
                
                missingFields.forEach(field => {
                    const fieldItem = document.createElement('div');
                    fieldItem.className = 'flex items-center gap-2 text-sm text-yellow-700';
                    fieldItem.innerHTML = `
                        <i class="fas fa-circle-xmark text-yellow-600"></i>
                        <span>${field}</span>
                    `;
                    fieldsList.appendChild(fieldItem);
                });
                
                const modal = document.getElementById('modalWarning');
                modal.classList.add('modal-visible');
                modal.classList.remove('modal-hidden', 'hidden');
                modal.style.display = 'flex';
                modal.style.visibility = 'visible';
                modal.style.opacity = '1';
                console.log('Warning modal ditampilkan');
            } catch (error) {
                console.error('Error in showWarningModal:', error);
            }
        }

        // Close warning modal
        function closeWarningModal() {
            const modal = document.getElementById('modalWarning');
            modal.classList.remove('modal-visible');
            modal.classList.add('modal-hidden', 'hidden');
            modal.style.display = 'none';
            modal.style.visibility = 'hidden';
            modal.style.opacity = '0';
        }

        // Show confirmation modal with data preview
        function showConfirmModal(nama, email, role) {
            try {
                const namaPrev = document.getElementById('confirmNama');
                const emailPrev = document.getElementById('confirmEmail');
                const rolePrev = document.getElementById('confirmRole');
                
                if (namaPrev) namaPrev.textContent = nama;
                if (emailPrev) emailPrev.textContent = email;
                if (rolePrev) rolePrev.textContent = role;
                
                const modal = document.getElementById('modalConfirm');
                modal.classList.add('modal-visible');
                modal.classList.remove('modal-hidden', 'hidden');
                modal.style.display = 'flex';
                modal.style.visibility = 'visible';
                modal.style.opacity = '1';
                console.log('Confirmation modal ditampilkan');
            } catch (error) {
                console.error('Error in showConfirmModal:', error);
            }
        }

        // Close confirmation modal
        function closeConfirmModal() {
            const modal = document.getElementById('modalConfirm');
            modal.classList.remove('modal-visible');
            modal.classList.add('modal-hidden', 'hidden');
            modal.style.display = 'none';
            modal.style.visibility = 'hidden';
            modal.style.opacity = '0';
        }

        // Submit form after confirmation
        function submitFormConfirmed() {
            try {
                closeConfirmModal();
                
                // Reset form fields
                const form = document.getElementById('addUserForm');
                form.reset();
                
                // Clear all field values explicitly
                document.getElementById('namaLengkap').value = '';
                document.getElementById('email').value = '';
                document.getElementById('role').value = '';
                document.getElementById('password').value = '';
                document.getElementById('konfirmPassword').value = '';
                
                const modal = document.getElementById('modalSuccess');
                modal.classList.add('modal-visible');
                modal.classList.remove('modal-hidden', 'hidden');
                modal.style.display = 'flex';
                modal.style.visibility = 'visible';
                modal.style.opacity = '1';
                
                console.log('Form berhasil di-reset dan success modal ditampilkan');
            } catch (error) {
                console.error('Error in submitFormConfirmed:', error);
            }
        }

        // Show success modal
        function showSuccessModal() {
            const modal = document.getElementById('modalSuccess');
            modal.classList.add('modal-visible');
            modal.classList.remove('modal-hidden', 'hidden');
            modal.style.display = 'flex';
            modal.style.visibility = 'visible';
            modal.style.opacity = '1';
        }

        // Close success modal and redirect
        function redirectToManagemen() {
            window.location.href = 'manajemenuser.html';
        }

        // Kembali ke halaman manajemen user (dari tombol batalkan)
        function kembaliKeManajemen() {
            window.location.href = 'manajemenuser.html';
        }

        // Show error modal
        function showErrorModal(message) {
            try {
                const modal = document.getElementById('modalError');
                const errorMessageElem = document.getElementById('errorMessage');
                if (errorMessageElem) {
                    errorMessageElem.textContent = message;
                }
                modal.classList.add('modal-visible');
                modal.classList.remove('modal-hidden', 'hidden');
                modal.style.display = 'flex';
                modal.style.visibility = 'visible';
                modal.style.opacity = '1';
                console.log('Error modal ditampilkan:', message);
            } catch (error) {
                console.error('Error in showErrorModal:', error);
            }
        }

        // Close error modal
        function closeErrorModal() {
            const modal = document.getElementById('modalError');
            modal.classList.remove('modal-visible');
            modal.classList.add('modal-hidden', 'hidden');
            modal.style.display = 'none';
            modal.style.visibility = 'hidden';
            modal.style.opacity = '0';
        }

        // Close modals on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = ['modalError', 'modalWarning', 'modalConfirm', 'modalSuccess'];
                modals.forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    modal.classList.remove('modal-visible');
                    modal.classList.add('modal-hidden', 'hidden');
                    modal.style.display = 'none';
                    modal.style.visibility = 'hidden';
                    modal.style.opacity = '0';
                });
            }
        });
    </script>
</body>
</html>
