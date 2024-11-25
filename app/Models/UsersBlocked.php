<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersBlocked extends Model
{
    use HasFactory;

    protected $table = 'usersBlockeds';

    protected $primaryKey = 'id_user_blocked';
    protected $fillable = [
        'id_user',
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id','id_user');
    }

    public function notification()
    {
        return $this->hasMany(Notification::class,'id_sender');
    }
}
