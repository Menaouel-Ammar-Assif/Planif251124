<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionsCopDr extends Model
{
    use HasFactory;
    protected $table = 'actionsCopDrs';

    protected $primaryKey = 'id_act_cop_dr';
    protected $fillable = [
        'lib_act_cop_dr',
        'dd',
        'df',
        'id_obj',
        'id_sous_obj',
        'id_dr',
        'etat',
        'code_act',
    ];
    public $timestamps = false;

    public function Objectif()
    {
        return $this->belongsTo(Objectif::class, 'id_obj');
    }

    public function SousObjectif()
    {
        return $this->belongsTo(SousObjectif::class, 'id_sous_obj');
    }

    public function indicateurs()
    {
        return $this->belongsToMany(Indicateur::class, 'actCopDrInds', 'id_act_cop_dr', 'id_ind');
    }

    public function actCopDrInds()
    {
        return $this->hasMany(ActCopDrInd::class, 'id_act_cop_dr');
    }

    public function Direction()
    {
        return $this->belongsTo(Direction::class, 'id_dr');
    }

}
