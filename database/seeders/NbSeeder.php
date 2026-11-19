<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NbSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            foreach ($this->sorok('klub.txt') as $sor) {
                DB::table('klub')->updateOrInsert(
                    ['id' => (int) $sor[0]],
                    ['csapatnev' => trim($sor[1])]
                );
            }

            foreach ($this->sorok('poszt.txt') as $sor) {
                DB::table('poszt')->updateOrInsert(
                    ['id' => (int) $sor[0]],
                    ['nev' => trim($sor[1])]
                );
            }

            foreach ($this->sorok('labdarugo.txt') as $sor) {
                DB::table('labdarugo')->updateOrInsert(
                    ['id' => (int) $sor[0]],
                    [
                        'mezszam' => (int) $sor[1],
                        'klubid' => (int) $sor[2],
                        'posztid' => (int) $sor[3],
                        'utonev' => trim($sor[4]) ?: null,
                        'vezeteknev' => trim($sor[5]),
                        'szulido' => str_replace('.', '-', trim($sor[6])),
                        'magyar' => (int) $sor[7] !== 0,
                        'kulfoldi' => (int) $sor[8] !== 0,
                        'ertek' => (int) $sor[9],
                    ]
                );
            }
        });
    }

    private function sorok(string $fajlnev): array
    {
        $utvonal = database_path('seeders/' . $fajlnev);
        $fajl = fopen($utvonal, 'r');

        if ($fajl === false) {
            throw new \RuntimeException("Nem található a fájl: {$fajlnev}");
        }

        $sorok = [];
        fgetcsv($fajl, 0, "\t", '"', '');

        while (($sor = fgetcsv($fajl, 0, "\t", '"', '')) !== false) {
            if ($sor !== [null]) {
                $sorok[] = $sor;
            }
        }

        fclose($fajl);

        return $sorok;
    }
}