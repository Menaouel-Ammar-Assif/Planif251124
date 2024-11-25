<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vda extends Model
{
    use HasFactory;

    protected $table = 'vdas';

    protected $primaryKey = 'id_vda';
    protected $fillable = [
        'id_dc',
        'id_dr',
        'id_volet',
        'id_act',
        // Add other columns
    ];
    public $timestamps = false;

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function DirectionC()
    {
        return $this->belongsTo(Direction::class, 'id_dc');
    }
    public function DirectionR()
    {
        return $this->belongsTo(Direction::class, 'id_dr');
    }

    public function Volet()
    {
        return $this->belongsTo(Volet::class, 'id_volet');
    }

    // public function Action()
    // {
    //     return $this->belongsTo(Action::class, 'id_act');
    // }

    public function Action()
    {
        return $this->hasMany(Action::class, 'id_act');
    }

    public function Description()
    {
        return $this->hasMany(Description::class, 'id_act');
    }
}
