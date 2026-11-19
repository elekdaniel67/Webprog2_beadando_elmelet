<?php

namespace Tests\Unit;

use App\Services\KedvezmenyKalkulator;
use PHPUnit\Framework\TestCase;

class KedvezmenyKalkulatorTest extends TestCase
{
    public function test_kiszamolja_a_kedvezmenyes_arat(): void
    {
        $kalkulator = new KedvezmenyKalkulator();

        $this->assertSame(800.0, $kalkulator->szamol(1000, 20));
    }

    public function test_nulla_szazaleknal_nem_valtozik_az_ar(): void
    {
        $kalkulator = new KedvezmenyKalkulator();

        $this->assertSame(1000.0, $kalkulator->szamol(1000, 0));
    }

    public function test_szaz_szazaleknal_nulla_a_fizetendo(): void
    {
        $kalkulator = new KedvezmenyKalkulator();

        $this->assertSame(0.0, $kalkulator->szamol(1000, 100));
    }

    public function test_ket_tizedesre_kerekiti_az_eredmenyt(): void
    {
        $kalkulator = new KedvezmenyKalkulator();

        $this->assertSame(66.67, $kalkulator->szamol(100, 33.333));
    }
}