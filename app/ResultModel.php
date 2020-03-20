<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultModel extends Model
{   
    protected $table = 'results';
    protected $primaryKey = 'id_result';
    protected $fillable =[
        'id_details',
        'id_parameter',
        'observations'
    ];
    public $timestamps = true;
}
