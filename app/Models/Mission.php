<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicule_id','departement_id',
        'chauffeur_id','type_mission',
        'date_debut','date_fin',
        'etat_mission'
    ];
}
