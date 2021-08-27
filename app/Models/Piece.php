<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;
        protected $fillable = [
        'fournisseur_id','user_id',
        'nom_piece','prix_piece'
    ];
}
