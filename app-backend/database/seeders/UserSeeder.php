<?php

namespace Database\Seeders;

use App\Models\Core\Auth\Landlord\User;
use App\Models\Core\Auth\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objUserLandlord = [
            [
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
            ],
        ];

        foreach ($objUserLandlord as $value) {
            $objUser = User::create([
                'email' => $value["email"],
                'password' =>  $value["password"],
                'email_verified_at' => now(),
            ]);
            $objRoleSuperAdmin = Role::findByName('Root', 'apiLandlord');
            $objUser->assignRole($objRoleSuperAdmin);
        }
    }
}
