<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopCible extends Model
{
    use HasFactory;

    protected $table = 'copCibles';

    protected $primaryKey = 'id_cop_cible';
    protected $fillable = [
        'id_ind',
        'cible',
        'annee',
        'unite',
        'cibleTrimestre',
        'cibleSemestre',
        'cibleT_Trimestre'
    ];
    public $timestamps = false;

    public function CopValeur()
    {
        return $this->hasMany(CopValeur::class, 'id_cop_cible');
    }

    public function indicateur()
    {
        return $this->belongsTo(Indicateur::class, 'id_ind');
    }

}
