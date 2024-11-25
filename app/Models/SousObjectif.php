<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousObjectif extends Model
{
    use HasFactory;
    protected $table = 'sousObjectifs';

    protected $primaryKey = 'id_sous_obj';
    protected $fillable = [
        'lib_sous_obj',
        'id_obj',
    ];
    public $timestamps = false;

    public function Objectif()
    {
        return $this->belongsTo(Objectif::class, 'id_obj');
    }

    public function ActionsCop()
    {
        return $this->hasMany(ActionsCop::class, 'id_sous_obj');
    }

    public function ActionsCopDr()
    {
        return $this->hasMany(ActionsCopDr::class, 'id_sous_obj');
    }

    public function Indicateur()
    {
        return $this->hasMany(Indicateur::class, 'id_sous_obj');
    }

    public function CopValeur()
    {
        return $this->hasMany(CopValeur::class, 'id_sous_obj');
    }
}
