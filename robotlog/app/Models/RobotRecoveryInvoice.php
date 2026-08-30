<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RobotRecoveryInvoice extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     * (Opsional jika nama tabel Anda jamak 'invoices' sesuai konvensi Laravel)
     *
     * @var string
     */
    protected $table = 'robot_recovery_invoices';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_no',
        'recovery_attempt',
    ];

    /**
     * Atribut standar yang harus dikonversi ke tipe data tertentu (Casting).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'recovery_attempt' => 'integer',
    ];
}
