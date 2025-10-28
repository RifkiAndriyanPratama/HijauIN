<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdminOrPetugas
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah sudah login
        if (! auth()->check()) {
            return redirect()->route('filament.admin.auth.login'); // arahkan ke login Filament
        }

        // Ambil nama role
        $role = auth()->user()->role->nama_role ?? null;

        // Kalau bukan admin/petugas → logout dan tolak akses
        if (! in_array($role, ['admin', 'petugas'])) {
            auth()->logout();
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Jika lolos, lanjutkan request
        return $next($request);
    }
}
