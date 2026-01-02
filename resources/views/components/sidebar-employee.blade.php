<!-- Sidebar Overlay (Mobile) -->
<div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<aside id="sidebar" class="sidebar-transition fixed top-0 left-0 z-50 h-full w-64 bg-gov-primary text-white -translate-x-full lg:translate-x-0">
    <!-- Logo -->
    <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10">
        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center flex-shrink-0">
            <i class="fas fa-building-columns text-gov-primary text-lg"></i>
        </div>
        <div class="sidebar-text">
            <h1 class="font-bold text-sm leading-tight">SIP-ASET</h1>
            <p class="text-xs text-white/70">Pendataan Aset</p>
        </div>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="px-3 py-4 space-y-1 overflow-y-auto h-[calc(100vh-180px)]">
        <!-- Dashboard -->
        <a href="{{ route('pegawai.dashboard') }}" class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors">
            <i class="fas fa-chart-pie w-5 text-center"></i>
            <span class="sidebar-text">Dashboard</span>
        </a>
        
        <!-- Data Aset (with Submenu) -->
        <div class="submenu-container">
            <button onclick="toggleSubmenu(this)" class="menu-item w-full flex items-center justify-between px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors">
                <div class="flex items-center gap-3">
                    <i class="fas fa-boxes-stacked w-5 text-center"></i>
                    <span class="sidebar-text">Data Aset</span>
                </div>
                <i class="fas fa-chevron-down text-xs sidebar-text transition-transform duration-300"></i>
            </button>
            <div class="submenu pl-8 space-y-1 mt-1">
                <a href="{{ route('aset.baru') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 text-sm text-white/80 hover:text-white transition-colors">
                    <i class="fas fa-box w-4 text-center text-xs"></i>
                    <span>Aset Terbaru</span>
                </a>
                <a href="{{ route('aset.terpakai') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 text-sm text-white/80 hover:text-white transition-colors">
                    <i class="fas fa-box-open w-4 text-center text-xs"></i>
                    <span>Aset Terpakai</span>
                </a>
            </div>
        </div>
    </nav>
    
    <!-- User Profile (Bottom) -->
    {{-- <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10 bg-gov-primary-dark">
        <div class="flex items-center gap-3">
    <div class="sidebar-text flex-1 min-w-0">
        <p class="text-sm font-medium truncate">
            {{ auth()->user()->name }}
        </p>
        <p class="text-xs text-white/60 truncate">
            {{ auth()->user()->email }}
        </p>
    </div>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="sidebar-text p-2 hover:bg-white/10 rounded-lg transition-colors"
            title="Logout">
            <i class="fas fa-right-from-bracket text-sm"></i>
        </button>
    </form>
</div> --}}

    </div>
</aside>
