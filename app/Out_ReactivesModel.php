<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Out_ReactivesModel extends Model
{
    protected $table = 'out_reactives';
    protected $primaryKey = 'id_out_reactives';
    protected $fillable =[
        'unitys',
        'id_reactive'
    ];
    public $timestamps = false;
}
