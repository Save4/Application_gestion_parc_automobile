<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicule_id','fileName','file',
        'fournisseur_id', 'debut_validite',
        'fin_validite','prix','user_id'
    ];
}
