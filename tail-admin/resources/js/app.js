import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

// --- 1. GLOBAL FETCH ENGINE ---
window.loadPage = async function (pageName, shouldPushState = true) {
    if (!pageName) return;

    const contentArea = document.getElementById("content-area");
    if (!contentArea) return;

    contentArea.innerHTML = getSkeletonHTML();
    contentArea.style.opacity = "1";

    try {
        await new Promise((resolve) => setTimeout(resolve, 200));

        const response = await fetch(`/ajax/page/${pageName}`);
        if (!response.ok) throw new Error("Halaman gagal diunduh.");

        const htmlOutput = await response.text();
        contentArea.innerHTML = htmlOutput;

        // Perbarui warna aktif di sidebar menu
        updateActiveMenu(pageName);

        if (shouldPushState) {
            const targetUrl = `/${pageName}`;
            history.pushState({ page: pageName }, "", targetUrl);
        }
    } catch (error) {
        contentArea.innerHTML = `<div class="bg-red-50 text-red-700 p-4 rounded-xl font-medium">Error: ${error.message}</div>`;
    }
};

// --- 2. SINKRONISASI WARNA MENU AKTIF ---
function updateActiveMenu(pageName) {
    document.querySelectorAll(".nav-link").forEach((link) => {
        link.classList.remove("bg-slate-800", "text-white");
        link.classList.add("text-slate-400");
    });

    const activeTarget = document.getElementById(`nav-link-${pageName}`);
    if (activeTarget) {
        activeTarget.classList.remove("text-slate-400");
        activeTarget.classList.add("bg-slate-800", "text-white");
    }
}

// --- 4. MEMUAT DAN MERENDER SIDEBAR MENU ---
async function loadSidebarMenu() {
    const nav = document.getElementById("sidebar-nav");
    if (!nav) return;

    try {
        const response = await fetch("/ajax/menu");
        if (!response.ok) throw new Error("Gagal memuat menu.");

        const menuItems = await response.json();
        let menuHtml = "";

        // Buat link menu
        menuItems.forEach((item) => {
            menuHtml += `
                <a id="nav-link-${item.id}" href="#" @click.prevent="loadPage('${item.pageName}'); sidebarOpen = false"
                    class="nav-link flex items-center w-full p-2 mt-4 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white group">
                    ${item.icon}
                    <span class="ms-3">${item.label}</span>
                </a>
            `;
        });

        // Tambahkan link logout secara manual di akhir
        menuHtml += `
            <form method="POST" action="/logout" class="mt-4">
                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute("content")}">
                <a href="/logout" onclick="event.preventDefault(); this.closest('form').submit();"
                   class="nav-link flex items-center w-full p-2 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/></svg>
                    <span class="ms-3 whitespace-nowrap">Keluar</span>
                </a>
            </form>
        `;
        nav.innerHTML = menuHtml;
    } catch (error) {
        nav.innerHTML = `<p class="text-red-400 p-4">${error.message}</p>`;
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
document.addEventListener("DOMContentLoaded", () => {
    // Muat menu sidebar saat halaman pertama kali dimuat
    loadSidebarMenu();

    window.addEventListener("popstate", (event) => {
        if (event.state && event.state.page) {
            window.loadPage(event.state.page, false);
        } else {
            window.loadPage("dashboard", false);
        }
    });

    window.initSidebarTooltips = function () {
        const textElements = document.querySelectorAll(".truncate-text");
        textElements.forEach((el) => {
            if (el.scrollWidth > el.clientWidth) {
                el.setAttribute("title", el.textContent.trim());
            } else {
                el.removeAttribute("title");
            }
        });
    };

    // Ambil path dari URL, hapus slash di awal, dan default ke 'dashboard' jika kosong.
    const initialPage = window.location.pathname.substring(1) || "dashboard";

    history.replaceState({ page: initialPage }, "", window.location.pathname);
    loadPage(initialPage, false); // Muat konten halaman awal
    updateActiveMenu(initialPage);
    window.initSidebarTooltips();
});
