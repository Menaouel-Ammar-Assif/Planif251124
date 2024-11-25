<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objectif extends Model
{
    use HasFactory;
    protected $table = 'objectifs';

    protected $primaryKey = 'id_obj';
    protected $fillable = [
        'lib_obj',
    ];
    public $timestamps = false;


    public function SousObjectif()
    {
        return $this->hasMany(SousObjectif::class, 'id_obj');
    }

    public function Indicateur()
    {
        return $this->hasManyThrough(Indicateur::class, SousObjectif::class , 'id_obj', 'id_sous_obj', 'id_obj', 'id_sous_obj'); //win kyn Foreign key diro+id obj+idsousobj
    }

    public function CopValeur()
    {
        return $this->hasMany(CopValeur::class, 'id_obj');
    }

}
