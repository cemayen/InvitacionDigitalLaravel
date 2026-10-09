<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Invitado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PdfTest extends TestCase
{
    use RefreshDatabase;

    public function test_family_can_download_guest_pdf_ticket()
    {
        $familia = User::create([
            'nombre_familia' => 'Familia PDF',
            'username' => 'familiapdf',
            'password' => 'password123',
            'cantidad_boletos' => 1,
            'rol' => 'Invitado',
        ]);

        $invitado = $familia->invitados()->create([
            'nombre_completo' => 'Invitado Especial',
            'confirmado' => true,
        ]);

        $response = $this->actingAs($familia)->get(route('cuenta.descargar-boleto', $invitado->id));

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }
}
