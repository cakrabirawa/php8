<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RobotFailureMail extends Mailable
{
    use Queueable, SerializesModels;

    // Definisikan variabel public agar otomatis terbaca di file Blade
    public $invoiceNo;

    public $batchJobId;

    public $timestamp;

    public function __construct($invoiceNo, $batchJobId, $timestamp)
    {
        $this->invoiceNo = $invoiceNo;
        $this->batchJobId = $batchJobId;
        $this->timestamp = $timestamp;
    }

    // Atur Judul Email (Subject)
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '⚠️ ALERT: Gagal Posting Invoice '.$this->invoiceNo,
        );
    }

    // Hubungkan ke file blade view yang kita buat di Langkah 2
    public function content(): Content
    {
        return new Content(
            view: 'emails.robot_failure',
        );
    }
}
