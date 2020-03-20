<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferenciaModel extends Model
{
    protected $table = 'referencias';
    protected $primaryKey = 'id_referencia';
    protected $fillable =[
        'referencia_name',
        'doi',
        'phone',
        'speciality',
        'email',
        'direction'
    ];
    public $timestamps = false;
}
