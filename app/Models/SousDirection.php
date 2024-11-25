<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousDirection extends Model
{
    use HasFactory;

    protected $table = 'sousDirections';

    protected $primaryKey = 'id_sous_dir';
    protected $fillable = [
        'lib_sous_dir',

    ];
    public $timestamps = false;

    // public function Direction()
    // {
    //     return $this->belongsToMany(Direction::class, 'corres','id_sous_dir', 'id_dir');
    // }

    public function DirSousDirBureaux()
    {
        return $this->hasMany(DirSousDirBureaux::class, 'id_sous_dir');
    }
}
