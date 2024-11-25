<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volet extends Model
{
    use HasFactory;

    protected $table = 'volets';

    protected $primaryKey = 'id_volet';
    protected $fillable = [
        'lib_volet',
    ];
    public $timestamps = false;


    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function Vda()
    {
        return $this->hasMany(VDA::class, 'id_volet');
    }
}
