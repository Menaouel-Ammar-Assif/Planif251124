<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicateur extends Model
{
    use HasFactory;
    protected $table = 'indicateurs';

    protected $primaryKey = 'id_ind';
    protected $fillable = [
        'lib_ind',
        'formule',
        'id_num',
        'id_denom',
        'id_chiffre',
        'type_p',
        'id_sous_obj'
    ];
    public $timestamps = false;


    public function CopInd()
    {
        return $this->hasMany(ActCopInd::class, 'id_ind');
    }

    public function cause()
    {
        return $this->hasMany(Cause::class, 'id_ind');
    }

    public function SousObjectif()
    {
        return $this->belongsTo(SousObjectif::class, 'id_sous_obj');
    }

    public function CopValeur()
    {
        return $this->hasMany(CopValeur::class, 'id_ind');
    }

    public function CopCible()
    {
        return $this->hasMany(CopCible::class, 'id_ind');
    }
}
