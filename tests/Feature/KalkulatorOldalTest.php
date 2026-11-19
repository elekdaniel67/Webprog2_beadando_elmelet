<?php

namespace Tests\Feature;

use Tests\TestCase;

class KalkulatorOldalTest extends TestCase
{
    public function test_a_kalkulator_oldal_megjelenik(): void
    {
        $valasz = $this->get(route('teszt'));

        $valasz->assertOk();
        $valasz->assertSee('Kedvezménykalkulátor');
    }

    public function test_helyesen_jeleniti_meg_az_eredmenyt(): void
    {
        $valasz = $this->post(route('teszt.szamol'), [
            'ar' => 1000,
            'kedvezmeny' => 20,
        ]);

        $valasz->assertOk();
        $valasz->assertSee('800,00 Ft');
    }

    public function test_elutasitja_a_negativ_arat(): void
    {
        $valasz = $this->post(route('teszt.szamol'), [
            'ar' => -100,
            'kedvezmeny' => 20,
        ]);

        $valasz->assertSessionHasErrors('ar');
    }

    public function test_elutasitja_a_tul_nagy_kedvezmenyt(): void
    {
        $valasz = $this->post(route('teszt.szamol'), [
            'ar' => 1000,
            'kedvezmeny' => 101,
        ]);

        $valasz->assertSessionHasErrors('kedvezmeny');
    }

    public function test_kotelezo_megadni_az_adatokat(): void
    {
        $valasz = $this->post(route('teszt.szamol'), []);

        $valasz->assertSessionHasErrors(['ar', 'kedvezmeny']);
    }
}