<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal Pendataan Aset - Sistem Informasi Pemerintah">
    <title>Masuk - Pendataan Aset</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'gov-blue': {
                            600: '#1e40af',
                            700: '#1d4ed8',
                            800: '#1e3a8a',
                            900: '#172554',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4 md:p-6">
    
    <!-- Container Utama -->
    <div class="w-full max-w-md">
        
        <!-- Card Login -->
        <div class="bg-white rounded-md shadow-lg p-6 md:p-8">
            
            <!-- Logo Pemerintah (Placeholder) -->
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-gov-blue-800 rounded-md flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v2h20V7L12 2zm0 2.18L18.18 7H5.82L12 4.18zM4 11v9h4v-6h8v6h4v-9H4zm6 9v-4h4v4h-4z"/>
                    </svg>
                </div>
            </div>
            
            <!-- Judul -->
            <h1 class="text-2xl font-semibold text-gray-800 text-center mb-2">
                Masuk ke Pendataan
            </h1>
            <p class="text-gray-500 text-center text-sm mb-8">
                Sistem Pendataan Aset Pemerintah
            </p>
            
            <!-- Form Login -->
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                
                <!-- Input Nama Pengguna -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama Pengguna
                    </label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        required
                        autocomplete="username"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gov-blue-600 focus:border-transparent transition duration-200"
                        placeholder="Masukkan nama pengguna"
                    >
                </div>
                
                <!-- Input Kata Sandi -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            autocomplete="current-password"
                            class="w-full px-4 py-2.5 pr-12 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gov-blue-600 focus:border-transparent transition duration-200"
                            placeholder="Masukkan kata sandi"
                        >
                        <!-- Tombol Show/Hide Password -->
                        <button 
                            type="button" 
                            id="togglePassword"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 focus:outline-none"
                            aria-label="Tampilkan kata sandi"
                        >
                            <!-- Icon Eye (Show) -->
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <!-- Icon Eye Off (Hide) - Hidden by default -->
                            <svg id="eyeOffIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Lupa Kata Sandi -->
                    <div class="flex justify-end mt-2">
                        <a href="#" class="text-sm text-gov-blue-700 hover:text-gov-blue-900 hover:underline focus:outline-none focus:underline">
                            Lupa Kata Sandi?
                        </a>
                    </div>
                </div>
                
                <!-- Captcha Checkbox -->
                <div class="bg-gray-50 border border-gray-200 rounded-md p-4">
                    <label class="flex items-center cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="captcha" 
                            required
                            class="w-5 h-5 text-gov-blue-700 border-gray-300 rounded focus:ring-gov-blue-600 focus:ring-2 cursor-pointer"
                        >
                        <span class="ml-3 text-sm text-gray-700">
                            Saya bukan robot
                        </span>
                        <div class="ml-auto">
                            <svg class="w-8 h-8 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                    </label>
                </div>
                
                <!-- Tombol Masuk -->
                <button 
                    type="submit" 
                    class="w-full bg-gov-blue-800 hover:bg-gov-blue-900 text-white font-medium py-3 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-gov-blue-600 focus:ring-offset-2"
                >
                    Masuk
                </button>
            </form>
            
            <!-- Error Message (Optional - untuk Laravel) -->
            @if($errors->any())
            <div class="mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        
        <!-- Footer -->
        <p class="text-center text-gray-500 text-xs mt-6">
            &copy; {{ date('Y') }} Pemerintah Republik Indonesia. Hak Cipta Dilindungi.
        </p>
        
    </div>
    
    <!-- Script Toggle Password -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            eyeIcon.classList.toggle('hidden');
            eyeOffIcon.classList.toggle('hidden');
            
            this.setAttribute('aria-label', 
                type === 'password' ? 'Tampilkan kata sandi' : 'Sembunyikan kata sandi'
            );
        });
    </script>
    
</body>
</html>