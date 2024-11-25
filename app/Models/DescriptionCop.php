<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptionCop extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'descriptionCops';

    protected $primaryKey = 'id_desc';
    protected $fillable = [
        'id_act_cop_dr',
        'faite',
        'a_faire',
        'probleme',
        'date',
        'etat',
        'date_update',
        'mois',
        'etat_mois',
    ];
    public $timestamps = false;


    public function actCopDrInd()
    {
        return $this->belongsTo(ActionsCopDr::class, 'id_act_cop_dr');
    }
}
