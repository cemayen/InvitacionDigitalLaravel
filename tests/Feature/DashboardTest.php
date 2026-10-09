<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Invitado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'nombre_familia' => 'Admin Mayén',
            'username' => 'BodaMayenTrejo',
            'password' => 'BodaMayenTrejo1527',
            'cantidad_boletos' => 2,
            'rol' => 'Admin',
        ]);
    }

    public function test_admin_can_register_new_family_with_automatic_tickets()
    {
        $response = $this->actingAs($this->admin)->post(route('dashboard.registro-familia.store'), [
            'nombre_familia' => 'Familia Pérez',
            'username' => 'familiaperez',
            'password' => 'password123',
            'cantidad_boletos' => 4,
            'opcion_cabana' => 1,
            'fecha_limite' => '2026-11-30',
        ]);

        $response->assertRedirect(route('dashboard.index'));
        $this->assertDatabaseHas('users', [
            'nombre_familia' => 'Familia Pérez',
            'username' => 'familiaperez',
            'cantidad_boletos' => 4,
        ]);

        $familia = User::where('username', 'familiaperez')->first();
        $this->assertCount(4, $familia->invitados);
    }

    public function test_admin_can_edit_family_and_adjust_ticket_counts()
    {
        $familia = User::create([
            'nombre_familia' => 'Familia López',
            'username' => 'familialopez',
            'password' => 'password123',
            'cantidad_boletos' => 2,
            'rol' => 'Invitado',
            'fecha_limite' => '2026-11-30',
        ]);

        for ($i = 0; $i < 2; $i++) {
            $familia->invitados()->create(['nombre_completo' => null, 'confirmado' => false]);
        }

        // Aumentar de 2 a 4 boletos
        $response = $this->actingAs($this->admin)->post(route('dashboard.editar-familia.update', $familia->id), [
            'nombre_familia' => 'Familia López Editada',
            'username' => 'familialopez',
            'cantidad_boletos' => 4,
            'fecha_limite' => '2026-12-15',
            'invitados' => [
                ['id' => $familia->invitados[0]->id, 'nombre_completo' => 'Juan López'],
                ['id' => $familia->invitados[1]->id, 'nombre_completo' => 'Maria López'],
            ]
        ]);

        $response->assertRedirect(route('dashboard.lista-invitados'));
        $familia->refresh();

        $this->assertEquals('Familia López Editada', $familia->nombre_familia);
        $this->assertEquals(4, $familia->cantidad_boletos);
        $this->assertCount(4, $familia->invitados);
        $this->assertTrue($familia->invitados[0]->confirmado);
        $this->assertEquals('Juan López', $familia->invitados[0]->nombre_completo);
    }

    public function test_admin_can_delete_family()
    {
        $familia = User::create([
            'nombre_familia' => 'Familia a Eliminar',
            'username' => 'eliminarme',
            'password' => 'password123',
            'cantidad_boletos' => 2,
            'rol' => 'Invitado',
        ]);

        $invitado = $familia->invitados()->create(['nombre_completo' => 'Persona 1', 'confirmado' => true]);

        $response = $this->actingAs($this->admin)->delete(route('dashboard.eliminar-familia', $familia->id));

        $response->assertRedirect(route('dashboard.index'));
        $this->assertDatabaseMissing('users', ['id' => $familia->id]);
        $this->assertDatabaseMissing('invitados', ['id' => $invitado->id]);
    }
}
