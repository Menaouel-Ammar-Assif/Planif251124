<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActCopInd extends Model
{
    use HasFactory;

    protected $table = 'actCopInds';

    protected $primaryKey = 'id_act_cop_ind';
    protected $fillable = [
        'id_act_cop',
        'id_ind',
    ];
    public $timestamps = false;

    public function ActionsCop()
    {
        return $this->belongsTo(ActionsCop::class, 'id_act_cop');
    }


    public function Indicateur()
    {
        return $this->belongsTo(Indicateur::class, 'id_ind');
    }
}
