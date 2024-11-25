<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActCopDrInd extends Model
{
    use HasFactory;
    protected $table = 'actCopDrInds';

    protected $primaryKey = 'id_act_cop_dr_ind';
    protected $fillable = [
        'id_act_cop_dr',
        'id_ind',
        'created_by',
    ];
    public $timestamps = false;


    public function ActionsCopDr()
    {
        return $this->belongsTo(ActionsCopDr::class, 'id_act_cop_dr');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function descriptionCop()
    {
        return $this->hasMany(DescriptionCop::class, 'id_desc');
    }
    public function indicateur()
    {
        return $this->belongsTo(Indicateur::class, 'id_ind');
    }
}
