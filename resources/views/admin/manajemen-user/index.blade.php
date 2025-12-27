<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - SIP-ASET | Sistem Informasi Pendataan Aset Pemerintah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style-admin.css">
</head>
<body class="bg-gray-100 font-inter">
    
    @include('components.sidebar-admin')
    
    <!-- Main Content Wrapper -->
    <div class="lg:ml-64 min-h-screen flex flex-col">
        
        <!-- Topbar -->
        <header class="sticky top-0 z-30 bg-white shadow-sm">
            <div class="flex items-center justify-between px-4 py-3 lg:px-6">
                <!-- Left: Hamburger + Title -->
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <div>
                        <h1 class="text-lg font-semibold text-gray-800">Manajemen User</h1>
                        <p class="text-xs text-gray-500 hidden sm:block">Kelola data pengguna sistem</p>
                    </div>
                </div>
                
                <!-- Right: Actions -->
                <div class="flex items-center gap-2 sm:gap-4">
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <main class="p-4 lg:p-6 flex-1">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h2>
                    <p class="text-gray-600 mt-1">Total 3 pengguna aktif</p>
                </div>
                <a href="form-tambah-pengguna.html" class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium flex items-center gap-2 text-sm whitespace-nowrap w-fit">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Pengguna</span>
                </a>
            </div>
            
            <!-- Search & Filter -->
            <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1 relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" placeholder="Cari nama atau email..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary">
                    </div>
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary text-sm bg-white">
                        <option value="">Semua Role</option>
                        <option value="admin">Administrator</option>
                        <option value="operator">Operator</option>
                        <option value="supervisor">Supervisor</option>
                    </select>
                </div>
            </div>
            
            <!-- Users Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[700px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Bergabung</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <!-- User 1 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-800">Admin Dinas</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">admin@sipaset.go.id</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                                        Administrator
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                        Aktif
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">01 Jan 2024</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <button onclick="openEditUserModal('Admin Dinas', 'admin@sipaset.go.id', 'Administrator')" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteConfirmModal('Admin Dinas')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- User 2 -->
                            <tr class="hover:bg-gray-50 transition-colors bg-gray-50/50">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-800">Budi Santoso</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">budi@sipaset.go.id</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                        Operator
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                        Aktif
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">15 Feb 2024</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <button onclick="openEditUserModal('Budi Santoso', 'budi@sipaset.go.id', 'Operator')" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteConfirmModal('Budi Santoso')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- User 3 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-800">Siti Nurhaliza</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">siti@sipaset.go.id</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        Supervisor
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500 mr-1.5"></span>
                                        Nonaktif
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">20 Mar 2024</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <button onclick="openEditUserModal('Siti Nurhaliza', 'siti@sipaset.go.id', 'Supervisor')" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteConfirmModal('Siti Nurhaliza')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="mt-6 flex items-center justify-between">
                <p class="text-sm text-gray-600">Menampilkan 1-3 dari 3 pengguna</p>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-2 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors disabled:opacity-50" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="px-3 py-2 text-sm bg-gov-primary text-white rounded-lg">1</button>
                    <button class="px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            </div>
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
            
            // Remove inline styles when opening to let CSS handle it
            if (submenu.classList.contains('open')) {
                submenu.style.maxHeight = '';
                submenu.style.overflow = '';
            }
        }
        
        // Toggle password visibility
        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            const button = event.currentTarget;
            
            if (field.type === 'password') {
                field.type = 'text';
                button.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                field.type = 'password';
                button.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }
        
        // Check if mobile
        function isMobile() {
            return window.innerWidth < 1024;
        }
        
        function openEditUserModal(nama, email, role) {
            const editUserModal = document.getElementById('editUserModal');
            const editSheetDesktop = document.getElementById('editSheetDesktop');
            const editSheetMobile = document.getElementById('editSheetMobile');
            const editBackdropMobile = document.getElementById('editBackdropMobile');
            
            // Populate desktop form
            document.getElementById('editNama').value = nama;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRole').value = role;
            document.getElementById('editPassword').value = '';
            document.getElementById('editConfirmPassword').value = '';
            
            // Populate mobile form
            document.getElementById('editNamaMobile').value = nama;
            document.getElementById('editEmailMobile').value = email;
            document.getElementById('editRoleMobile').value = role;
            document.getElementById('editPasswordMobile').value = '';
            document.getElementById('editConfirmPasswordMobile').value = '';
            
            // Show modal
            if (isMobile()) {
                editBackdropMobile.classList.remove('hidden');
                editBackdropMobile.classList.add('visible');
                editSheetMobile.classList.remove('hidden');
                editSheetMobile.classList.add('visible');
            } else {
                editUserModal.classList.remove('hidden');
                editSheetDesktop.classList.remove('hidden');
            }
            
            document.body.style.overflow = 'hidden';
        }
        
        function closeEditUserModal() {
            const editUserModal = document.getElementById('editUserModal');
            const editSheetDesktop = document.getElementById('editSheetDesktop');
            const editSheetMobile = document.getElementById('editSheetMobile');
            const editBackdropMobile = document.getElementById('editBackdropMobile');
            
            if (isMobile()) {
                editBackdropMobile.classList.remove('visible');
                editBackdropMobile.classList.add('hiding');
                editSheetMobile.classList.remove('visible');
                editSheetMobile.classList.add('hiding');
                
                setTimeout(() => {
                    editBackdropMobile.classList.add('hidden');
                    editBackdropMobile.classList.remove('hiding');
                    editSheetMobile.classList.add('hidden');
                    editSheetMobile.classList.remove('hiding');
                    document.body.style.overflow = '';
                }, 400);
            } else {
                editSheetDesktop.classList.add('hidden');
                editUserModal.classList.add('hidden');
                document.body.style.overflow = '';
            }
            
            document.getElementById('editUserForm').reset();
        }
        
        // Handle Edit User Form Submit
        function handleEditUserSubmit(event) {
            event.preventDefault();
            
            const nama = document.getElementById('editNama').value.trim();
            const email = document.getElementById('editEmail').value.trim();
            const role = document.getElementById('editRole').value;
            const password = document.getElementById('editPassword').value;
            const confirmPassword = document.getElementById('editConfirmPassword').value;
            
            // Validation
            if (!nama) {
                showErrorModal('Mohon masukkan nama lengkap');
                return;
            }
            
            if (!email) {
                showErrorModal('Mohon masukkan email');
                return;
            }
            
            if (!email.includes('@')) {
                showErrorModal('Format email tidak valid');
                return;
            }
            
            if (!role) {
                showErrorModal('Mohon pilih role');
                return;
            }
            
            if (password && password !== confirmPassword) {
                showErrorModal('Password tidak sesuai');
                return;
            }
            
            // Close modal
            closeEditUserModal();
            
            // Show success message
            showSuccessModal('Pengguna berhasil diperbarui!');
        }
        
        // Show Error Modal
        function showErrorModal(message) {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('validationErrorModal').classList.remove('hidden');
        }
        
        // Close Error Modal
        function closeErrorModal() {
            document.getElementById('validationErrorModal').classList.add('hidden');
        }
        
        // Show Success Modal
        function showSuccessModal(message) {
            document.getElementById('successMessage').textContent = message;
            document.getElementById('validationSuccessModal').classList.remove('hidden');
        }
        
        // Close Success Modal
        function closeSuccessModal() {
            document.getElementById('validationSuccessModal').classList.add('hidden');
        }
        
        // Open Delete Confirmation Modal
        function openDeleteConfirmModal(userName) {
            document.getElementById('deleteUserName').textContent = userName;
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }
        
        // Close Delete Confirmation Modal
        function closeDeleteConfirmModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }
        
        // Confirm Delete User
        function confirmDeleteUser() {
            closeDeleteConfirmModal();
            showSuccessModal('Pengguna berhasil dihapus!');
        }
        
        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure submenus are collapsed on Manajemen User page
            function collapseAllSubmenus() {
                console.log('Collapsing submenus...');
                const containers = document.querySelectorAll('.submenu-container');
                console.log('Found containers:', containers.length);
                containers.forEach(container => {
                    const submenu = container.querySelector('.submenu');
                    const button = container.querySelector('button');
                    const chevron = button.querySelector('.fa-chevron-down');
                    
                    console.log('Before - open class:', submenu.classList.contains('open'));
                    // Ensure submenu is closed by removing open class and setting max-height to 0
                    submenu.classList.remove('open');
                    submenu.style.maxHeight = '0';
                    submenu.style.overflow = 'hidden';
                    
                    if (chevron.classList.contains('rotate-180')) {
                        chevron.classList.remove('rotate-180');
                    }
                    // Remove active class from button
                    if (button.classList.contains('active')) {
                        button.classList.remove('active');
                    }
                    console.log('After - open class:', submenu.classList.contains('open'));
                });
            }
            
            // Call it immediately
            collapseAllSubmenus();
            
            // Call it again after a short delay to ensure it works
            setTimeout(collapseAllSubmenus, 50);
            setTimeout(collapseAllSubmenus, 100);
            
            // Track navigation to close submenus when leaving to other pages
            document.addEventListener('click', function(e) {
                const link = e.target.closest('a[href]');
                if (!link) return;
                
                const href = link.getAttribute('href');
                // If navigating to a page that's NOT manajemenuser, close submenus
                if (!href.includes('manajemenuser')) {
                    collapseAllSubmenus();
                }
            });
            
            // Sidebar close on click outside
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
            
            // Window resize handler
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
            
            // Edit User Modal - Close when clicking outside
            const editUserModal = document.getElementById('editUserModal');
            if (editUserModal) {
                editUserModal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeEditUserModal();
                    }
                });
            }
            
            // Add User Form Submission
            const addUserForm = document.getElementById('addUserForm');
            if (addUserForm) {
                addUserForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const nama = document.getElementById('nama').value.trim();
                    const email = document.getElementById('email').value.trim();
                    const role = document.getElementById('role').value;
                    const password = document.getElementById('password').value;
                    const confirmPassword = document.getElementById('confirm_password').value;
                    
                    // Validation
                    if (!nama) {
                        showErrorModal('Mohon masukkan nama lengkap');
                        return;
                    }
                    
                    if (!email) {
                        showErrorModal('Mohon masukkan email');
                        return;
                    }
                    
                    if (!email.includes('@')) {
                        showErrorModal('Format email tidak valid');
                        return;
                    }
                    
                    if (!role) {
                        showErrorModal('Mohon pilih role');
                        return;
                    }
                    
                    if (!password) {
                        showErrorModal('Mohon masukkan password');
                        return;
                    }
                    
                    if (password.length < 6) {
                        showErrorModal('Password minimal 6 karakter');
                        return;
                    }
                    
                    if (!confirmPassword) {
                        showErrorModal('Mohon konfirmasi password');
                        return;
                    }
                    
                    if (password !== confirmPassword) {
                        showErrorModal('Password dan konfirmasi password tidak cocok');
                        return;
                    }
                    
                    // Success
                    showSuccessModal('Pengguna berhasil ditambahkan!');
                    setTimeout(() => {
                        closeSuccessModal();
                        closeAddUserModal();
                        document.getElementById('addUserForm').reset();
                    }, 2000);
                });
            }
            
            // Edit User Form Submission
            const editUserForm = document.getElementById('editUserForm');
            if (editUserForm) {
                editUserForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const nama = document.getElementById('editNama').value.trim();
                    const email = document.getElementById('editEmail').value.trim();
                    const role = document.getElementById('editRole').value;
                    const password = document.getElementById('editPassword').value;
                    const confirmPassword = document.getElementById('editConfirmPassword').value;
                    
                    // Validation
                    if (!nama) {
                        showErrorModal('Mohon masukkan nama lengkap');
                        return;
                    }
                    
                    if (!email) {
                        showErrorModal('Mohon masukkan email');
                        return;
                    }
                    
                    if (!email.includes('@')) {
                        showErrorModal('Format email tidak valid');
                        return;
                    }
                    
                    if (!role) {
                        showErrorModal('Mohon pilih role');
                        return;
                    }
                    
                    // Password validation only if password is filled
                    if (password || confirmPassword) {
                        if (password.length < 6) {
                            showErrorModal('Password minimal 6 karakter');
                            return;
                        }
                        
                        if (password !== confirmPassword) {
                            showErrorModal('Password dan konfirmasi password tidak cocok');
                            return;
                        }
                    }
                    
                    // Success
                    showSuccessModal('Pengguna berhasil diperbarui!');
                    setTimeout(() => {
                        closeSuccessModal();
                        closeEditUserModal();
                        document.getElementById('editUserForm').reset();
                    }, 2000);
                });
            }
        });
        
    </script>
    
    <!-- Add User Modal -->
    
    <!-- Edit User Modal -->
    <div id="editUserModal" class="fixed inset-0 z-50 hidden">
        <!-- Desktop Backdrop -->
        <div id="editBackdropDesktop" class="modal-backdrop absolute inset-0 bg-black/50 hidden lg:block" onclick="closeEditUserModal()"></div>
        
        <!-- Desktop Modal Sheet -->
        <div id="editSheetDesktop" class="modal-sheet lg:modal-sheet-desktop hidden lg:block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full lg:max-w-2xl bg-white rounded-2xl shadow-xl lg:max-h-[90vh] overflow-y-auto">
            <div class="p-6 lg:p-8">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Edit Pengguna</h3>
                    <button onclick="closeEditUserModal()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <!-- Form -->
                <form id="editUserForm" onsubmit="handleEditUserSubmit(event)">
                    <!-- Nama Lengkap -->
                    <div class="mb-4">
                        <label for="editNama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="editNama" name="nama" placeholder="Masukkan nama lengkap" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary">
                    </div>
                    
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="editEmail" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="editEmail" name="email" placeholder="Masukkan email" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary">
                    </div>
                    
                    <!-- Role -->
                    <div class="mb-4">
                        <label for="editRole" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select id="editRole" name="role" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary">
                            <option value="">-- Pilih Role --</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Operator">Operator</option>
                            <option value="Supervisor">Supervisor</option>
                        </select>
                    </div>
                    
                    <!-- Password -->
                    <div class="mb-4">
                        <label for="editPassword" class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-xs font-normal text-gray-500">(Kosongkan jika tidak ingin mengubah)</span></label>
                        <div class="relative">
                            <input type="password" id="editPassword" name="password" placeholder="Masukkan password baru (opsional)" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary pr-10">
                            <button type="button" onclick="togglePasswordVisibility('editPassword')" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Konfirmasi Password -->
                    <div class="mb-6">
                        <label for="editConfirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <div class="relative">
                            <input type="password" id="editConfirmPassword" name="confirm_password" placeholder="Konfirmasi password" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary pr-10">
                            <button type="button" onclick="togglePasswordVisibility('editConfirmPassword')" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center gap-3 pt-6 border-t border-gray-100">
                        <button type="submit" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                            <i class="fas fa-check"></i>
                            Simpan Perubahan
                        </button>
                        <button type="button" onclick="closeEditUserModal()" class="flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                            <i class="fas fa-times"></i>
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Mobile Bottom Sheet Version -->
    <div id="editBackdropMobile" class="modal-backdrop lg:hidden fixed inset-0 z-40 hidden bg-black/10" onclick="closeEditUserModal()"></div>
    
    <div id="editSheetMobile" class="lg:hidden fixed inset-0 z-50 hidden flex flex-col pointer-events-none">
        <div class="relative z-10 mt-auto w-full flex flex-col bg-white rounded-t-3xl pointer-events-auto">
            <!-- Handle Bar -->
            <div class="flex justify-center pt-3 pb-2">
                <div class="w-12 h-1 bg-gray-300 rounded-full"></div>
            </div>
            
            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto px-6 pb-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Edit Pengguna</h3>
                    <button onclick="closeEditUserModal()" class="p-2 -mr-2 text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                
                <!-- Form -->
                <form id="editUserFormMobile" onsubmit="handleEditUserSubmit(event)" class="space-y-5">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="editNamaMobile" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="editNamaMobile" name="nama" placeholder="Masukkan nama lengkap" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary">
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label for="editEmailMobile" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="editEmailMobile" name="email" placeholder="Masukkan email" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary">
                    </div>
                    
                    <!-- Role -->
                    <div>
                        <label for="editRoleMobile" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select id="editRoleMobile" name="role" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary">
                            <option value="">-- Pilih Role --</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Operator">Operator</option>
                            <option value="Supervisor">Supervisor</option>
                        </select>
                    </div>
                    
                    <!-- Password -->
                    <div>
                        <label for="editPasswordMobile" class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-xs font-normal text-gray-500">(Opsional)</span></label>
                        <div class="relative">
                            <input type="password" id="editPasswordMobile" name="password" placeholder="Masukkan password baru (opsional)" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary pr-10">
                            <button type="button" onclick="togglePasswordVisibility('editPasswordMobile')" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Konfirmasi Password -->
                    <div>
                        <label for="editConfirmPasswordMobile" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <div class="relative">
                            <input type="password" id="editConfirmPasswordMobile" name="confirm_password" placeholder="Konfirmasi password" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gov-primary/20 focus:border-gov-primary pr-10">
                            <button type="button" onclick="togglePasswordVisibility('editConfirmPasswordMobile')" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="flex-shrink-0 flex gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50">
                <button type="button" onclick="closeEditUserModal()" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times"></i>
                    Batal
                </button>
                <button type="submit" form="editUserFormMobile" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                    <i class="fas fa-check"></i>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
    
    <!-- Validation Error Modal -->
    <div id="validationErrorModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation text-3xl text-red-600"></i>
                </div>
            </div>
            <h2 class="text-lg font-semibold text-center text-gray-800 mb-2">Perhatian</h2>
            <p class="text-center text-gray-600 text-sm mb-6" id="errorMessage">Mohon isi semua field yang diperlukan</p>
            <button onclick="closeErrorModal()" class="w-full px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-semibold text-sm">
                Tutup
            </button>
        </div>
    </div>
    
    <!-- Validation Success Modal -->
    <div id="validationSuccessModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-3xl text-green-600"></i>
                </div>
            </div>
            <h2 class="text-lg font-semibold text-center text-gray-800 mb-2">Berhasil!</h2>
            <p class="text-center text-gray-600 text-sm mb-6" id="successMessage">Pengguna berhasil ditambahkan!</p>
            <button onclick="closeSuccessModal()" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-semibold text-sm">
                Tutup
            </button>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation text-3xl text-red-600"></i>
                </div>
            </div>
            <h2 class="text-lg font-semibold text-center text-gray-800 mb-2">Hapus Pengguna?</h2>
            <p class="text-center text-gray-600 text-sm mb-6">Apakah Anda yakin ingin menghapus pengguna <strong id="deleteUserName"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex gap-3">
                <button onclick="closeDeleteConfirmModal()" class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-semibold text-sm">
                    Batal
                </button>
                <button onclick="confirmDeleteUser()" class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-semibold text-sm">
                    Hapus
                </button>
            </div>
        </div>
    </div>
    
</body>
</html>
