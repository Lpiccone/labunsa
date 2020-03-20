<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailsModel extends Model
{
    protected $table = 'details';
    protected $primaryKey = 'id_details';
    protected $fillable = [
        'id_headboards', 
        'id_analysis',
        'observation',
        'price'
    ];
    public $timestamps = true;
}
