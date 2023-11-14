<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dataRestrictions = [];
        for ($i = 1; $i <= 25; $i++) {
            $restrictionType = rand(0, 2);
            switch ($restrictionType) {
                case 0:
                    $restriction = 'none';
                    break;
                case 1:
                    $restriction = rand(500, 10000);
                    break;
                case 2:
                    $year = rand(2023, 2024);
                    $month = rand(1, 12);
                    $day = rand(1, 28);
                    $restriction = sprintf('%02d.%02d.%d', $day, $month, $year);
                    break;
            }
            $dataRestrictions[] = [
                'id' => $i,
                'service' => 'Services' . $i,
                'token' => 'Token' . chr(65 + $i % 26),
                'restriction' => $restriction,
                'data' => json_encode(['key' => 'value' . $i]),
            ];
        }

        DB::table('restrictions')->upsert($dataRestrictions, ['id'], ['service', 'token', 'restriction', 'data']);

    }
}
