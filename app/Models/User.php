<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
}
