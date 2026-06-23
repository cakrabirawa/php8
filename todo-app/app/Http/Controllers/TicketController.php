<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class TicketController
{
    public function analitycalView(Request $request)
    {
        if ($request->is('/')) {
            if ($request->header('X-Injected-Page')) {
                return view('pages.analytics');
            }
            return view('welcome', ['pageView' => 'pages.analytics', 'pageTitle' => 'Analytics - TailAdmin']);
        }
    }
    // Method untuk menampilkan Halaman Daftar Tiket
    public function listView(Request $request)
    {
        // Jika ini adalah request untuk halaman utama, tampilkan halaman analytics.
        // Ini memungkinkan kita menggunakan controller yang sama untuk dua rute berbeda.
        if ($request->is('/')) {
            if ($request->header('X-Injected-Page')) {
                return view('pages.analytics');
            }
            return view('welcome', ['pageView' => 'pages.analytics', 'pageTitle' => 'Analytics - TailAdmin']);
        }

        // Logika yang sudah ada untuk menampilkan daftar tiket
        $tickets = Ticket::orderBy('created_at', 'desc')->get();

        if ($request->header('X-Injected-Page')) {
            return view('pages.ticket-list', compact('tickets'));
        }

        return view('welcome', [
            'pageView' => 'pages.ticket-list',
            'pageTitle' => 'Ticket List - TailAdmin',
            'tickets' => $tickets
        ]);
    }

    // Method untuk menampilkan Detail Chat Tiket dengan Paging AJAX (Diperbarui)
    public function replyView(Request $request)
    {
        // Definisikan fungsi JavaScript yang akan disuntikkan ke view.
        // Ini akan menangani pembaruan dinamis (AJAX) untuk daftar chat.
        // DIPINDAHKAN KE ATAS agar tersedia untuk semua jenis request (initial load & AJAX).
        $jsFunction = <<<JS
        <script>
            if (typeof window.loadChatPage !== 'function') {
                window.loadChatPage = function(url) {
                    fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-Injected-Page': 'true'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        // Ganti isi dari container chat dengan konten baru dari AJAX
                        const chatContainer = document.getElementById('chat-list-container');
                        if (chatContainer) {
                            chatContainer.innerHTML = html;
                        }
                    })
                    .catch(error => console.error('Error loading chat page:', error));
                }
            }
        </script>
        JS;

        // Ambil info tiket utama
        $ticket = Ticket::first();

        if (!$ticket) {
            return "Data tiket belum ada. Silakan jalankan seeder terlebih dahulu.";
        }

        // Ambil data replies chat yang dipaginasi (5 pesan per halaman)
        $replies = $ticket->replies()->latest()->paginate(5);

        // JIKA REQUEST VIA AJAX FETCH UNTUK UPDATE HALAMAN TIKET / PAGING TIKET
        if ($request->header('X-Injected-Page')) {
            // Jika request meminta fragmen paging chat saja
            if ($request->has('page_only')) {
                return view('pages.partials.chat-list-fragment', compact('replies', 'ticket'));
            }
            // KEMBALIKAN KE SEMULA: Kirim view parsial untuk SPA, dan suntikkan JS langsung ke dalamnya.
            // Ini akan mencegah layout ganda.
            return view('pages.ticket-reply', compact('ticket', 'replies', 'jsFunction'));
        }

        return view('welcome', [
            'pageView' => 'pages.ticket-reply',
            'pageTitle' => 'Ticket Reply - TailAdmin' . $jsFunction, // Suntikkan JS ke pageTitle
            'ticket' => $ticket,
            'replies' => $replies
        ]);
    }

    // Method untuk menyimpan chat reply baru via AJAX POST
    public function storeReply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $reply = TicketReply::create([
            'ticket_id' => $id,
            'sender_name' => 'Musharof Chowdhury',
            'sender_email' => 'musharof@tailadmin.com',
            'message' => $request->message,
            'is_admin' => true
        ]);

        return view('pages.partials.single-reply', compact('reply'));
    }
}
