<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirSousDirBureaux extends Model
{
    use HasFactory;

    protected $table = 'dirSousDirBureauxs';

    protected $primaryKey = 'id';
    protected $fillable = [
        'id_dc',
        'id_sous_dir',
        'id_bureau',
    ];
    public $timestamps = false;

    public function Direction()
    {
        return $this->belongsTo(Direction::class, 'id_dir');
    }

    public function SousDirection()
    {
        return $this->belongsTo(SousDirection::class, 'id_sous_dir');
    }

    public function Bureau()
    {
        return $this->belongsTo(Bureau::class, 'id_bureau');
    }

}
