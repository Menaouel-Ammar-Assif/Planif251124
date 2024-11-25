<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bureau extends Model
{
    use HasFactory;
    protected $table = 'bureauxs';

    protected $primaryKey = 'id_bureau';
    protected $fillable = [
        'lib_bureau',
    ];
    public $timestamps = false;

    public function DirSousDirBureaux()
    {
        return $this->hasMany(DirSousDirBureaux::class, 'id_bureau');
    }
}
