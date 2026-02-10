<?php

namespace Database\Seeders;

use App\Models\InvitationCode;
use Illuminate\Database\Seeder;

class InvitationCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $codes = [
            ['code' => 'AURIEILY', 'max_guests' => 3],
            ['code' => 'FAMILY01', 'max_guests' => 5],
            ['code' => 'FAMILY02', 'max_guests' => 4],
            ['code' => 'FRIENDS01', 'max_guests' => 2],
            ['code' => 'GODPARENTS', 'max_guests' => 2],
        ];

        foreach ($codes as $codeData) {
            InvitationCode::create($codeData);
        }
    }
}
