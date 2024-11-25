<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumDenom extends Model
{
    use HasFactory;
    protected $table = 'numDenoms';

    protected $primaryKey = 'id_num_denom';
    protected $fillable = [
        'lib_num_denom',
        'id_dc',
        'unite',
    ];
    public $timestamps = false;

    public function Direction()
    {
        return $this->belongsTo(Direction::class, 'id_dc');
    }

    public function NumDenomVals()
    {
        return $this->hasMany(NumDenomVals::class, 'id_num_denom');
    }
}
