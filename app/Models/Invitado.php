<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitado extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre_completo',
        'confirmado',
    ];

    protected function casts(): array
    {
        return [
            'confirmado' => 'boolean',
        ];
    }

    /**
     * Relación N a 1: Un invitado pertenece a una familia/usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
