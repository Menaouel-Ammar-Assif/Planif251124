<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumDenomVals extends Model
{
    use HasFactory;
    protected $table = 'numDenomVals';

    protected $primaryKey = 'id_val';
    protected $fillable = [
        'id_num_denom',
        'val',
        'date',
        'id_dc',
        'unite',
        'created_at'
    ];
    public $timestamps = false;

    public function Direction()
    {
        return $this->belongsTo(Direction::class, 'id_dc');
    }

    public function NumDenom()
    {
        return $this->belongsTo(NumDenom::class, 'id_num_denom');
    }
}
