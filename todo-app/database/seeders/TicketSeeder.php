<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Ticket;
use App\Models\TicketReply;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        // 1. NONAKTIFKAN pengecekan foreign key agar MySQL mengizinkan penghapusan data
        Schema::disableForeignKeyConstraints();

        // 2. Bersihkan data lama dengan aman tanpa hambatan relasi
        TicketReply::truncate();
        Ticket::truncate();

        // 3. AKTIFKAN KEMBALI pengecekan foreign key setelah pembersihan selesai
        Schema::enableForeignKeyConstraints();

        // ========================================================
        // MULAI SUNTIK DATA BARU
        // ========================================================

        // Tiket Pertama (In-Progress)
        $ticket1 = Ticket::create([
            'ticket_id' => '#346520',
            'subject' => 'Sidebar not responsive on mobile',
            'customer_name' => 'John Doe',
            'customer_email' => 'johndoe@gmail.com',
            'category' => 'General Support',
            'status' => 'In-Progress'
        ]);

        TicketReply::create([
            'ticket_id' => $ticket1->id,
            'sender_name' => 'John Doe',
            'sender_email' => 'johndoe@gmail.com',
            'message' => "Hi TailAdmin Team,\n\nI hope you're doing well.\n\nI'm currently working on customizing the TailAdmin dashboard and would like to add a new section labeled 'Reports'. Before I proceed, I wanted to check if there's any official guide or best practice you recommend.",
            'is_admin' => false
        ]);

        TicketReply::create([
            'ticket_id' => $ticket1->id,
            'sender_name' => 'Musharof Chowdhury',
            'sender_email' => 'musharof@tailadmin.com',
            'message' => "Hi John D,\n\nThanks for reaching out—and great to hear you're customizing TailAdmin to fit your needs! Yes, you can definitely add custom pages like a 'Reports' section. Go to the sidebar configuration file and add your new route entry there.",
            'is_admin' => true
        ]);

        // Tiket Kedua (Solved)
        $ticket2 = Ticket::create([
            'ticket_id' => '#346521',
            'subject' => 'Gagal koneksi database di Docker environment',
            'customer_name' => 'Budi Santoso',
            'customer_email' => 'budi.san@outlook.com',
            'category' => 'Technical Issue',
            'status' => 'Solved'
        ]);

        TicketReply::create([
            'ticket_id' => $ticket2->id,
            'sender_name' => 'Budi Santoso',
            'sender_email' => 'budi.san@outlook.com',
            'message' => "Halo tim, saya mendapatkan error 'Connection refused' saat mencoba menjalankan aplikasi Laravel ini di dalam Docker compose. Mohon bantuannya.",
            'is_admin' => false
        ]);

        // Tiket Ketiga (On-Hold)
        $ticket3 = Ticket::create([
            'ticket_id' => '#346522',
            'subject' => 'Request kustomisasi komponen Chart warna ungu',
            'customer_name' => 'Siti Aminah',
            'customer_email' => 'siti.aminah@company.id',
            'category' => 'Feature Request',
            'status' => 'On-Hold'
        ]);

        TicketReply::create([
            'ticket_id' => $ticket3->id,
            'sender_name' => 'Siti Aminah',
            'sender_email' => 'siti.aminah@company.id',
            'message' => "Apakah ada opsi mudah untuk mengubah palet warna bawaan grafik bar chart menjadi gradasi ungu gelap tanpa harus mengubah core library?",
            'is_admin' => false
        ]);
    }
}
