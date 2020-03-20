<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class In_ReactivesModel extends Model
{
    protected $table = 'in_reactives';
    protected $primaryKey = 'id_in_reactive';
    protected $fillable =[
        'unitys',
        'id_reactive',
        'observations'
    ];
    public $timestamps = false;
}
