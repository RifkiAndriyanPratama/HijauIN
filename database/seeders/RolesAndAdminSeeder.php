<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndAdminSeeder extends Seeder
{
    public function run()
    {
        $roles = ['masyarakat', 'petugas', 'pemerintah', 'admin'];
        foreach ($roles as $r) {
            Role::firstOrCreate(['nama_role' => $r]);
        }

        if (!User::where('email', 'admin@example.com')->exists()) {
            $adminRole = Role::where('nama_role', 'admin')->first();
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRole->id,
            ]);
        }
    }
}
