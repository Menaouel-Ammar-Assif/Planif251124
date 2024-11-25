<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopValeur extends Model
{
    use HasFactory;
    protected $table = 'copValeurs';

    protected $primaryKey = 'id_cop_val';
    protected $fillable = [
        'id_obj',
        'id_sous_obj',
        'id_ind',
        'num',
        'denom',
        'result',
        'periode',
        'id_cop_cible',
        'ecart',
        'ecartType',
        'id_dc',
        'ecartP',
        'ecartTypeP'

    ];
    public $timestamps = false;

    public function copCible()
    {
        return $this->belongsTo(CopCible::class, 'id_cop_cible');
    }

    public function objectif()
    {
        return $this->belongsTo(Objectif::class, 'id_obj');
    }

    public function sousObjectif()
    {
        return $this->belongsTo(SousObjectif::class, 'id_sous_obj');
    }

    public function indicateur()
    {
        return $this->belongsTo(Indicateur::class, 'id_ind');
    }

}
