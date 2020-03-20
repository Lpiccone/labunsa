<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReactivesModel extends Model
{
    protected $table = 'reactives';
    protected $primaryKey = 'id_reactive';
    protected $fillable =[
        'name',
        'unitys',
        'id_analysis'
    ];
    public $timestamps = false;
}
