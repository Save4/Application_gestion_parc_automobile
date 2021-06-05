<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
    protected $fillable = [
        'modele_id', 'categorie_id', 'transmission',
        'type_energie', 'plaque', 'nombre_place',
        'annee_fabrication', 'annee_sortie'
    ];
}
