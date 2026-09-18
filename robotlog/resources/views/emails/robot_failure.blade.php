<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robot Posting Failure Alert</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; color: #333333; margin: 0; padding: 0; }
        .email-container { max-width: 600px; margin: 30px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border-top: 5px solid #e11d48; }
        .header { background-color: #fff1f2; padding: 25px; text-align: center; border-bottom: 1px solid #fecdd3; }
        .header h2 { color: #be123c; margin: 0; font-size: 20px; font-weight: 600; display: inline-block; vertical-align: middle; }
        .content { padding: 30px 25px; line-height: 1.6; }
        .alert-text { font-size: 16px; color: #4b5563; margin-bottom: 25px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; background-color: #f8fafc; border-radius: 6px; overflow: hidden; }
        .info-table td { padding: 12px 15px; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        .info-table td.label { font-weight: 600; color: #64748b; width: 35%; }
        .info-table td.value { color: #1e293b; font-family: 'Courier New', Courier, monospace; font-weight: bold; }
        .badge { background-color: #fef3c7; color: #d97706; padding: 6px 12px; border-radius: 50px; font-size: 13px; font-weight: 600; display: inline-block; }
        .footer { background-color: #f8fafc; padding: 15px 25px; text-align: center; border-top: 1px solid #edf2f7; font-size: 12px; color: #94a3b8; }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="header">
            <h2>⚠️ Robot Posting Failure Alert</h2>
        </div>

        <div class="content">
            <p class="alert-text">
                Sistem mendeteksi adanya kegagalan dalam proses pemrosesan oleh <strong>Robot Posting</strong>. Detail kegagalan transaksi dapat dilihat di bawah ini:
            </p>

            <table class="info-table">
                <tr>
                    <td class="label">Invoice No</td>
                    <!-- Variabel Dinamis Laravel Blade -->
                    <td class="value">{{ $invoiceNo }}</td> 
                </tr>
                <tr>
                    <td class="label">Batch Job ID</td>
                    <td class="value">{{ $batchJobId }}</td>
                </tr>
                <tr>
                    <td class="label">Status Tindakan</td>
                    <td><span class="badge">Proses Recovery Otomatis</span></td>
                </tr>
            </table>

            <p class="alert-text" style="margin-bottom: 0;">
                Sistem sedang berupaya melakukan proses <strong>recovery segera</strong>. Tidak ada tindakan manual yang diperlukan saat ini kecuali jika status tidak berubah dalam beberapa menit ke depan.
            </p>
        </div>

        <div class="footer">
            Sent automatically from <strong>D365 Robot</strong> @ {{ $timestamp }}
        </div>
    </div>

</body>
</html>
