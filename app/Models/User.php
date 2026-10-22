<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre_familia',
        'username',
        'email',
        'password',
        'cantidad_boletos',
        'opcion_cabana',
        'fecha_limite',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'opcion_cabana' => 'boolean',
            'fecha_limite' => 'date',
        ];
    }

    /**
     * Relación 1 a N: Una familia (User) tiene varios boletos/invitados.
     */
    public function invitados(): HasMany
    {
        return $this->hasMany(Invitado::class);
    }
    public function accesoUrl(): string
    {
        return URL::signedRoute('acceso', ['user' => $this->id]);
    }
    public function urlNormal(): string
    {
        return route('inicio.index'); 
    }

    public function whatsappUrl(): string
    {
        $mensaje = "¡Hola {$this->nombre_familia}! Este es tu enlace para confirmar tu asistencia:\n"
                . $this->accesoUrl()
                . "\n\nTienes hasta el " . $this->fecha_limite->format('d/m/Y') . ' para confirmar.';

        return 'https://wa.me/?text=' . rawurlencode($mensaje);
    }
    public function mensajeAcceso(): string
    {
        return "¡Hola familia {$this->nombre_familia}! \n"
            ."¡Nos hace muy felices darles esta noticia! Queremos que sean parte fundamental de uno de los días más importantes de nuestras vidas y nos encantaría que nos acompañen a celebrar nuestra boda. \n"
            ."Preparamos un espacio digital con toda la información y detalles para este gran día. Pueden verlo aquí: \n"
            ."🔗 Invitación: {$this->urlNormal()} \n"
            ."Credenciales de acceso: \n Usuario: {$this->username} \n Contraseña: {$this->username}1527 \n"
            ."O si prefieres ingresar de inmediato con un solo clic, usa este enlace: \n"
            ."Acceso directo: {$this->accesoUrl()}"
            ."\n\n¡Esperamos de corazón contar con su presencia para festejar juntos! ❤️"
            . "\n\nTienes hasta el " . $this->fecha_limite->format('d/m/Y') . ' para confirmar.';
    }
}
