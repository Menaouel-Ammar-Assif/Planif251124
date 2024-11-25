<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corre extends Model
{
    use HasFactory;

    protected $table = 'corres';

    protected $primaryKey = 'id_cor';
    protected $fillable = [
        'id_dc',
        'id_sous_dir',
    ];
    public $timestamps = false;

    // public function CorresBureau()
    // {
    //     return $this->hasMany(CorresBureau::class, 'id_cor');
    // }
}
