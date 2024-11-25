<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionsPro extends Model
{
    use HasFactory;
    protected $table = 'actionsPros';

    protected $primaryKey = 'id_act_pro';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'lib_act_pro',
        'dd',
        'df',
        'id_obj',
        'id_sous_obj',
    ];
    

    // public function Objectif()
    // {
    //     return $this->belongsTo(Objectif::class, 'id_obj');
    // }

    // public function SousObjectif()
    // {
    //     return $this->belongsTo(SousObjectif::class, 'id_sous_obj');
    // }

    // public function indicateurs()
    // {
    //     return $this->belongsToMany(Indicateur::class, 'actionsProInds', 'id_act_pro', 'id_ind');
    // }

    public function directions()
    {
        return $this->belongsToMany(Direction::class, 'actionsProDrs', 'id_act_pro', 'id_dir');
    }

    public function actionsProDrs()
    {
        return $this->hasMany(ActionsProDr::class, 'id_act_pro');
    }
}
