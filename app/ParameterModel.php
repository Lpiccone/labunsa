<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterModel extends Model
{
    protected $table = 'parameters';
    protected $primaryKey = 'id_parameter';
    protected $fillable =[
        'id_analysis',
        'name_parameter',
        'value_min',
        'value_max',
        'unity'
    ];
    public $timestamps = false;
}
