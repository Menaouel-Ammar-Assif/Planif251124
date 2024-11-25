<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prioritaires extends Model
{
    protected $table = 'prioritairess';

    protected $primaryKey = 'id_p';
    protected $fillable = [
        'lib_p',
    ];
    public $timestamps = false;

    public function Action()
    {
        return $this->hasMany(Action::class, 'id_p');
    }

}
