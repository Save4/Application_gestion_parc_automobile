<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparation extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicule_id', 'piece_id', 'user_id',
        'type_panne', 'nombre', 'prix_toto_piece',
        'main_oeuvre', 'toto_conso'
    ];
}
