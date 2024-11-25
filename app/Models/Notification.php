<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $primaryKey = 'id_notif';
    protected $fillable = [
        'id_sender',
        'id_receiver',
        'message',
        'date',
        'direction',
    ];
    public $timestamps = false;
    
    public function userBlocked()
    {
        return $this->belongsTo(UsersBlocked::class, 'id_sender');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_sender');
    }
}
