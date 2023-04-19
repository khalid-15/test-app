<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $csvFile = fopen(base_path("database/seeders/csv/users.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                User::create([
                    "id" => $data['0'],
                    "first_name" => $data['1'],
                    "last_name" => $data['2'],
                    "email" => $data['3'],
                    "is_admin" => $data['4'],
                    "is_confirmed" => $data['5'],
                    "password" => $data['7'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
