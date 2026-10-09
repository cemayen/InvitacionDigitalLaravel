<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Invitado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CuentaTest extends TestCase
{
    use RefreshDatabase;

    public function test_family_can_view_account_page_and_save_guests()
    {
        $familia = User::create([
            'nombre_familia' => 'Familia Martínez',
            'username' => 'familiamartinez',
            'password' => 'password123',
            'cantidad_boletos' => 2,
            'rol' => 'Invitado',
            'fecha_limite' => now()->addDays(5)->format('Y-m-d'),
        ]);

        $inv1 = $familia->invitados()->create(['nombre_completo' => null, 'confirmado' => false]);
        $inv2 = $familia->invitados()->create(['nombre_completo' => null, 'confirmado' => false]);

        $response = $this->actingAs($familia)->get(route('cuenta.index'));
        $response->assertStatus(200);

        // Guardar invitados
        $saveResponse = $this->actingAs($familia)->post(route('cuenta.guardar-invitados'), [
            'invitados' => [
                ['id' => $inv1->id, 'nombre_completo' => 'Carlos Martínez'],
                ['id' => $inv2->id, 'nombre_completo' => 'Ana Martínez'],
            ],
        ]);

        $saveResponse->assertRedirect(route('cuenta.index'));

        $this->assertDatabaseHas('invitados', [
            'id' => $inv1->id,
            'nombre_completo' => 'Carlos Martínez',
            'confirmado' => true,
        ]);
        $this->assertDatabaseHas('invitados', [
            'id' => $inv2->id,
            'nombre_completo' => 'Ana Martínez',
            'confirmado' => true,
        ]);
    }

    public function test_cannot_save_guests_if_expired()
    {
        $familia = User::create([
            'nombre_familia' => 'Familia Expirada',
            'username' => 'expirada',
            'password' => 'password123',
            'cantidad_boletos' => 1,
            'rol' => 'Invitado',
            'fecha_limite' => now()->subDays(2)->format('Y-m-d'),
        ]);

        $inv1 = $familia->invitados()->create(['nombre_completo' => null, 'confirmado' => false]);

        $response = $this->actingAs($familia)->post(route('cuenta.guardar-invitados'), [
            'invitados' => [
                ['id' => $inv1->id, 'nombre_completo' => 'Intento Tardío'],
            ],
        ]);

        $response->assertRedirect(route('cuenta.index'));
        $response->assertSessionHas('error');

        $this->assertDatabaseHas('invitados', [
            'id' => $inv1->id,
            'nombre_completo' => null,
            'confirmado' => false,
        ]);
    }
}
