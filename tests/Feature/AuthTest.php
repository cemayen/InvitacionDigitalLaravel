<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_username_and_password()
    {
        $user = User::create([
            'nombre_familia' => 'Familia Test',
            'username' => 'familiatest',
            'password' => 'password123',
            'cantidad_boletos' => 2,
            'rol' => 'Invitado',
        ]);

        $response = $this->post('/login', [
            'username' => 'familiatest',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('cuenta.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_redirects_to_dashboard_after_login()
    {
        $admin = User::create([
            'nombre_familia' => 'Admin Test',
            'username' => 'admintest',
            'password' => 'password123',
            'cantidad_boletos' => 2,
            'rol' => 'Admin',
        ]);

        $response = $this->post('/login', [
            'username' => 'admintest',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard.index'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_unauthenticated_user_cannot_access_dashboard()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect(route('login'));
    }

    public function test_non_admin_cannot_access_dashboard()
    {
        $user = User::create([
            'nombre_familia' => 'Familia Normal',
            'username' => 'familianormal',
            'password' => 'password123',
            'cantidad_boletos' => 2,
            'rol' => 'Invitado',
        ]);

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(403);
    }
}
