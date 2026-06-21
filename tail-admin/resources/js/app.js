import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const mobileToggle = document.getElementById('mobile-toggle');
    const sidebarClose = document.getElementById('sidebar-close');
    const desktopToggle = document.getElementById('desktop-toggle');
    const contentArea = document.getElementById('content-area');
    const navLinks = document.querySelectorAll('.nav-link');

    // 1. Drawer Menu Mobile Action (Buka/Tutup di Handphone)
    function toggleMobileSidebar() {
        if (sidebar && overlay) {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    }
    if (mobileToggle) mobileToggle.addEventListener('click', toggleMobileSidebar);
    if (sidebarClose) sidebarClose.addEventListener('click', toggleMobileSidebar);
    if (overlay) overlay.addEventListener('click', toggleMobileSidebar);

    // 2. TOGGLE SHOW/HIDE SIDEBAR DESKTOP (Didaftarkan ke Global Window Scope)
    window.toggleDesktopSidebar = function (e) {
        if (e) e.preventDefault();

        const targetSidebar = document.getElementById('sidebar');
        const btnToggle = e ? e.currentTarget : document.querySelector('[onclick*="toggleDesktopSidebar"]');

        if (targetSidebar) {
            // Memaksa manipulasi kelas lebar v4
            targetSidebar.classList.toggle('md:w-0');

            if (btnToggle) {
                if (targetSidebar.classList.contains('md:w-0')) {
                    btnToggle.setAttribute('title', 'Tampilkan Sidebar');
                } else {
                    btnToggle.setAttribute('title', 'Sembunyikan Sidebar');
                }
            }

            // Hitung ulang keakuratan tooltip text setelah animasi pulsa/bounce selesai
            if (typeof initSidebarTooltips === 'function') {
                setTimeout(initSidebarTooltips, 550);
            }
        }
    };

    // 3. Multilevel Accordion Dropdown Trigger
    document.querySelectorAll('.submenu-toggle').forEach(button => {
        button.addEventListener('click', (e) => {
            e.stopPropagation();
            const content = button.nextElementSibling;
            const arrow = button.querySelector('.arrow-icon');
            if (content && content.classList.contains('submenu-content')) {
                content.classList.toggle('hidden');
                if (arrow) arrow.classList.toggle('rotate-180');
            }
        });
    });

    // 4. FETCH ENGINE DENGAN HISTORY API & SKELETON LOADING
    async function loadPage(pageName, shouldPushState = true) {
        if (!pageName) return;

        contentArea.innerHTML = getSkeletonHTML();
        contentArea.style.opacity = '1';

        try {
            await new Promise(resolve => setTimeout(resolve, 200));

            const response = await fetch(`/ajax/page/${pageName}`);
            if (!response.ok) throw new Error('Halaman gagal diunduh.');

            const htmlOutput = await response.text();
            contentArea.innerHTML = htmlOutput;

            updateActiveMenu(pageName);

            if (shouldPushState) {
                const targetUrl = pageName === 'dashboard' ? '/dashboard' : `/${pageName}`;
                history.pushState({ page: pageName }, '', targetUrl);
            }

            // Tutup otomatis drawer mobile jika klik link di layar kecil
            if (sidebar && !sidebar.classList.contains('-translate-x-full') && window.innerWidth < 768) {
                toggleMobileSidebar();
            }

        } catch (error) {
            contentArea.innerHTML = `<div class="bg-red-50 text-red-700 p-4 rounded-xl font-medium">Error: ${error.message}</div>`;
        }
    }

    function updateActiveMenu(pageName) {
        navLinks.forEach(link => {
            link.classList.remove('bg-slate-800', 'text-white');
            link.classList.add('text-slate-400');
            if (link.getAttribute('data-page') === pageName) {
                link.classList.remove('text-slate-400');
                link.classList.add('bg-slate-800', 'text-white');
            }
        });
    }

    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            loadPage(link.getAttribute('data-page'), true);
        });
    });

    window.addEventListener('popstate', (event) => {
        if (event.state && event.state.page) {
            loadPage(event.state.page, false);
        } else {
            loadPage('dashboard', false);
        }
    });

    // 5. AUTOMATIC TOOLTIP FOR OVERFLOW TEXT
    function initSidebarTooltips() {
        const textElements = document.querySelectorAll('.truncate-text');
        textElements.forEach(el => {
            if (el.scrollWidth > el.clientWidth) {
                el.setAttribute('title', el.textContent.trim());
            } else {
                el.removeAttribute('title');
            }
        });
    }

    const currentPath = window.location.pathname.replace('/', '');
    const initialPage = currentPath === '' || currentPath === 'dashboard' ? 'dashboard' : currentPath;
    history.replaceState({ page: initialPage }, '', window.location.pathname);
    updateActiveMenu(initialPage);
    initSidebarTooltips();
});

function getSkeletonHTML() {
    return `
        <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-200 animate-pulse">
            <div class="h-7 bg-gray-200 rounded-md w-1/4 mb-4"></div>
            <div class="h-4 bg-gray-200 rounded-md w-1/2 mb-8"></div>
            <div class="space-y-3">
                <div class="grid grid-cols-3 gap-4"><div class="h-4 bg-gray-200 rounded-md col-span-2"></div><div class="h-4 bg-gray-200 rounded-md col-span-1"></div></div>
            </div>
            <div class="mt-8 h-32 bg-gray-100 rounded-xl w-full"></div>
        </div>
    `;
}
