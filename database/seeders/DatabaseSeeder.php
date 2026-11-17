<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
        
        $sutiPath = database_path('seeders/suti.txt');
        if (file_exists($sutiPath)) {
            $lines = file($sutiPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach (array_slice($lines, 1) as $line) { // kihagyjuk a fejlécet
                [$id, $nev, $tipus, $dijazott] = explode("\t", $line);
                DB::table('suti')->insert([
                    'id' => $id,
                    'nev' => trim($nev),
                    'tipus' => trim($tipus),
                    'dijazott' => (int)trim($dijazott),
                ]);
            }
        }

        
        $arPath = database_path('seeders/ar.txt');
        if (file_exists($arPath)) {
            $lines = file($arPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach (array_slice($lines, 1) as $line) {
                $parts = explode("\t", $line);
                DB::table('ar')->insert([
                    'id' => $parts[0],
                    'sutiid' => $parts[1],
                    'ertek' => $parts[2],
                    'egyseg' => isset($parts[3]) ? trim($parts[3]) : null,
                ]);
            }
        }

        
        $tartalomPath = database_path('seeders/tartalom.txt');
        if (file_exists($tartalomPath)) {
            $lines = file($tartalomPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach (array_slice($lines, 1) as $line) {
                [$id, $sutiid, $mentes] = explode("\t", $line);
                DB::table('tartalom')->insert([
                    'id' => $id,
                    'sutiid' => $sutiid,
                    'mentes' => trim($mentes),
                ]);
            }
        }
    }
}
