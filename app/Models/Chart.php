<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    use HasFactory;

    protected $table = 'charts';

    protected $primaryKey = 'id_chart';
    protected $fillable = [
        'date',
        'avncT',
        'avncdc',
        'avncdr'
    ];
    public $timestamps = false;
}
