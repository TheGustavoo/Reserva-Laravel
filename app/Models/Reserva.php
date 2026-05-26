<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'professor_id', 
        'sala_id', 
        'data_reserva', 
        'hora_inicio', 
        'hora_fim',
        'equipamento_id'

    ];

    public function professor() {
        return $this->belongsTo(Professor::class);
    }

    public function sala() {
        return $this->belongsTo(Sala::class);
    }

    public function equipamento() {
        return $this->belongsTo(Equipamento::class);
    }
}
