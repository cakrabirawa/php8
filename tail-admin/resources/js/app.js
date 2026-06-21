import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// --- 1. GLOBAL FETCH ENGINE ---
window.loadPage = async function (pageName, shouldPushState = true) {
    if (!pageName) return;

    const contentArea = document.getElementById('content-area');
    if (!contentArea) return;

    contentArea.innerHTML = getSkeletonHTML();
    contentArea.style.opacity = '1';

    try {
        await new Promise(resolve => setTimeout(resolve, 200));

        const response = await fetch(`/ajax/page/${pageName}`);
        if (!response.ok) throw new Error('Halaman gagal diunduh.');

        const htmlOutput = await response.text();
        contentArea.innerHTML = htmlOutput;

        // Perbarui warna aktif di sidebar menu
        updateActiveMenu(pageName);

        if (shouldPushState) {
            const targetUrl = pageName === 'dashboard' ? '/dashboard' : `/${pageName}`;
            history.pushState({ page: pageName }, '', targetUrl);
        }

    } catch (error) {
        contentArea.innerHTML = `<div class="bg-red-50 text-red-700 p-4 rounded-xl font-medium">Error: ${error.message}</div>`;
    }
};

// --- 2. SINKRONISASI WARNA MENU AKTIF ---
function updateActiveMenu(pageName) {
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('bg-slate-800', 'text-white');
        link.classList.add('text-slate-400');
    });

    const activeTarget = document.getElementById(`nav-link-${pageName}`);
    if (activeTarget) {
        activeTarget.classList.remove('text-slate-400');
        activeTarget.classList.add('bg-slate-800', 'text-white');
    }
}

function getSkeletonHTML() {
    return `
        <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-200 animate-pulse max-w-4xl mx-auto">
            <div class="h-7 bg-gray-200 rounded-md w-1/4 mb-4"></div>
            <div class="h-4 bg-gray-200 rounded-md w-1/2 mb-8"></div>
            <div class="space-y-3">
                <div class="grid grid-cols-3 gap-4"><div class="h-4 bg-gray-200 rounded-md col-span-2"></div><div class="h-4 bg-gray-200 rounded-md col-span-1"></div></div>
            </div>
            <div class="mt-8 h-32 bg-gray-100 rounded-xl w-full"></div>
        </div>
    `;
}

// --- 3. MANAJEMEN EVENT LISTENER BROWSER BROWSER BACK/FORWARD (POPSTATE) ---
document.addEventListener('DOMContentLoaded', () => {

    window.addEventListener('popstate', (event) => {
        if (event.state && event.state.page) {
            window.loadPage(event.state.page, false);
        } else {
            window.loadPage('dashboard', false);
        }
    });

    window.initSidebarTooltips = function () {
        const textElements = document.querySelectorAll('.truncate-text');
        textElements.forEach(el => {
            if (el.scrollWidth > el.clientWidth) {
                el.setAttribute('title', el.textContent.trim());
            } else {
                el.removeAttribute('title');
            }
        });
    };

    const currentPath = window.location.pathname.replace('/', '');
    const initialPage = currentPath === '' || currentPath === 'dashboard' ? 'dashboard' : currentPath;

    history.replaceState({ page: initialPage }, '', window.location.pathname);
    updateActiveMenu(initialPage);
    window.initSidebarTooltips();
});
