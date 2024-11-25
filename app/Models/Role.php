<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'id_role';
    protected $fillable = [
        'lib_role',
        'id_user',
        // Add other columns
    ];
    public $timestamps = false;

    // public function User()
    // {
    //     return $this->hasMany(User::class, 'id_user');
    // }

}
