<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSSROle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $auth = auth()->user();
        
        // 1. Ambil ID dari URL secara dinamis (bisa {id} atau {employee})
        $targetId = $request->route('employee') ?? $request->route('id');

        // 2. Jika ada parameter ID di URL, lakukan pengecekan
        if ($targetId) {
            
            // Aturan khusus Role Sales Superintendent
            if ($auth->role === 'sales_superintendent') {
                
                // CEK 1: Jika yang diakses adalah Onboarding (menggunakan employee_id/email)
                // CEK 2: Jika yang diakses adalah IDP (menggunakan ID Primary Key di tabel IDP)
                
                // Agar simpel, kita bandingkan dengan email user login (asumsi employee_id == email)
                // Jika targetId di URL bukan milik user yang login, blokir!
                if ($auth->email !== $targetId) {
                    
                    // Tambahan: Jika ini adalah ID Primary Key (seperti pada route IDP edit {id})
                    // Kita perlu pastikan record IDP tersebut memang milik user ini
                    if (is_numeric($targetId)) {
                        $ownsRecord = \App\Models\IndividualDevelopmentPlan::where('id', $targetId)
                            ->where('employee_id', $auth->email)
                            ->exists();
                            
                        if (!$ownsRecord) abort(403, 'Akses Ditolak: Ini bukan data Anda.');
                    } else {
                        abort(403, 'Akses Ditolak: Anda tidak boleh mengakses ID orang lain.');
                    }
                }
            }
        }

        return $next($request);
    }
}
