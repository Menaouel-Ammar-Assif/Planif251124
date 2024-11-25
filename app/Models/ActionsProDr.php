<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionsProDr extends Model
{
    use HasFactory;
    protected $table = 'actionsProDrs';

    protected $primaryKey = 'id_act_pro_dr';
    protected $fillable = [
        'id_act_pro',
        // 'id_ind',
        'id_dir',
        'created_by',
        'lib_created_by',
        'lib_dir'
    ];
    public $timestamps = false;


    public function ActionsPro()
    {
        return $this->belongsTo(ActionsPro::class, 'id_act_pro');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
