/**
 * Sidebar JavaScript - Handles sidebar toggle and submenu management
 */

/**
 * Toggle Sidebar (Mobile)
 */
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (sidebar && overlay) {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
}

/**
 * Toggle Submenu
 */
function toggleSubmenu(button) {
    const container = button.closest('.submenu-container');
    if (!container) return;
    
    const submenu = container.querySelector('.submenu');
    const chevron = button.querySelector('.fa-chevron-down');
    const menuText = button.querySelector('.sidebar-text');
    
    if (submenu && chevron) {
        submenu.classList.toggle('open');
        chevron.classList.toggle('rotate-180');
        
        // Save state to sessionStorage
        if (menuText && menuText.textContent === 'Data Aset') {
            sessionStorage.setItem('dataAsetSubmenuOpen', submenu.classList.contains('open'));
        }
    }
}

/**
 * Manage submenu state based on page location
 */
window.addEventListener('DOMContentLoaded', function() {
    const currentPage = window.location.pathname;
    const isMasterDataPage = currentPage.includes('form-kategori-aset') || currentPage.includes('form-kondisi-aset');
    const isDataAsetPage = currentPage.includes('aset-baru') || currentPage.includes('aset-terpakai') || currentPage.includes('manajemen-aset');
    
    const containers = document.querySelectorAll('.submenu-container');
    
    containers.forEach(container => {
        const button = container.querySelector('button');
        const menuText = button.querySelector('.sidebar-text');
        const submenu = container.querySelector('.submenu');
        const chevron = button.querySelector('.fa-chevron-down');
        
        if (!submenu || !chevron) return;
        
        // Open appropriate submenu without animation and add active class
        if (isMasterDataPage && menuText && menuText.textContent === 'Master Data') {
            button.classList.add('active');
            submenu.classList.add('no-transition');
            chevron.classList.add('no-transition');
            
            if (!submenu.classList.contains('open')) {
                submenu.classList.add('open');
            }
            if (!chevron.classList.contains('rotate-180')) {
                chevron.classList.add('rotate-180');
            }
            
            setTimeout(() => {
                submenu.classList.remove('no-transition');
                chevron.classList.remove('no-transition');
            }, 50);
        } else if (isDataAsetPage && menuText && menuText.textContent === 'Data Aset') {
            button.classList.add('active');
            
            const savedState = sessionStorage.getItem('dataAsetSubmenuOpen');
            
            if (savedState === null || savedState === 'true') {
                submenu.classList.add('no-transition');
                chevron.classList.add('no-transition');
                
                if (!submenu.classList.contains('open')) {
                    submenu.classList.add('open');
                }
                if (!chevron.classList.contains('rotate-180')) {
                    chevron.classList.add('rotate-180');
                }
                
                setTimeout(() => {
                    submenu.classList.remove('no-transition');
                    chevron.classList.remove('no-transition');
                }, 50);
            } else if (savedState === 'false') {
                submenu.classList.remove('open');
                chevron.classList.remove('rotate-180');
            }
        } else {
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

/**
 * Handle navigation to close submenu when leaving Master Data or Data Aset
 */
document.addEventListener('click', function(e) {
    const link = e.target.closest('a[href]');
    if (!link) return;
    
    const href = link.getAttribute('href');
    const currentPage = window.location.pathname;
    const isMasterDataPage = currentPage.includes('form-kategori-aset') || currentPage.includes('form-kondisi-aset');
    const isDataAsetPage = currentPage.includes('aset-baru') || currentPage.includes('aset-terpakai') || currentPage.includes('manajemen-aset');
    
    const isNavigatingAwayFromMasterData = isMasterDataPage && 
                                          !href.includes('form-kategori-aset') && 
                                          !href.includes('form-kondisi-aset');
    const isNavigatingAwayFromDataAset = isDataAsetPage && 
                                         !href.includes('aset-baru') && 
                                         !href.includes('aset-terpakai') &&
                                         !href.includes('manajemen-aset');
    
    if (isNavigatingAwayFromMasterData) {
        sessionStorage.setItem('closeMasterDataSubmenu', 'true');
    }
    if (isNavigatingAwayFromDataAset) {
        sessionStorage.setItem('closeDataAsetSubmenu', 'true');
    }
});

/**
 * Handle window resize
 */
window.addEventListener('resize', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (window.innerWidth >= 1024) {
        if (sidebar) sidebar.classList.remove('-translate-x-full');
        if (overlay) overlay.classList.add('hidden');
    } else {
        if (sidebar) sidebar.classList.add('-translate-x-full');
    }
});

/**
 * Close sidebar when clicking outside of it
 */
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleButton = event.target.closest('[onclick="toggleSidebar()"]');
    
    if (!sidebar || !overlay) return;
    
    // If clicked on toggle button, let toggleSidebar() handle it
    if (toggleButton) return;
    
    // If sidebar is visible on mobile and click is outside sidebar
    if (window.innerWidth < 1024 && 
        !sidebar.classList.contains('-translate-x-full') && 
        !sidebar.contains(event.target)) {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    }
});
