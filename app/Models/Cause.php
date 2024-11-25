<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;
    protected $table = 'causes';

    protected $primaryKey = 'id_cause';

    protected $fillable = [
        'id_ind',
        'periode',
        'date_remplissage',
        'lib_cause',
        'lib_correct',
        'id_dir',
    ];

    public $timestamps = false; 
    public function indicateur()
    {
        return $this->belongsTo(Indicateur::class, 'id_ind');
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class, 'id_dir');
    }
}
