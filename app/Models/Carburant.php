<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carburant extends Model
{
    use HasFactory;
    protected $fillable = [
        'mission_id','type_carburant',
        'quantite','prix_unitaire',
        'prix_total','distance',
        'distance_littre','date_conso'
    ];
}
