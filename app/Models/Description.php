<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $table = 'descriptions';

    protected $primaryKey = 'id_desc';
    protected $fillable = [
        'id_act',
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

    
    public function Action()
    {
        return $this->belongsTo(Action::class, 'id_act');
    }
    
}
