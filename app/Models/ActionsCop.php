<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionsCop extends Model
{
    use HasFactory;

    protected $table = 'actionsCops';

    protected $primaryKey = 'id_act_cop';
    protected $fillable = [
        'lib_act_cop',
        'dd',
        'df',
        'id_sous_obj',
        'id_act',
        'lib_dc',
    ];
    public $timestamps = false;

    public function SousObjectif()
    {
        return $this->belongsTo(SousObjectif::class, 'id_sous_obj');
    }

    public function ActCopInd()
    {
        return $this->hasMany(ActCopInd::class, 'id_act_cop');
    }

    public function actions()
    {
        return $this->belongsTo(Action::class, 'id_act');
    }

}
