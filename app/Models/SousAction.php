<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousAction extends Model
{
    use HasFactory;

    protected $table = 'sousActions';

    protected $primaryKey = 'id_sous_act';
    protected $fillable = [
        'lib_sous_act',
        'dd',
        'df',
        'etat',
        'id_act',
        'description',
        'signale',
        // Add other columns
    ];
    public $timestamps = false;

    
    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function Action()
    {
        return $this->belongsTo(Action::class, 'id_act');
    }
}
