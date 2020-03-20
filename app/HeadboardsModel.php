<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeadboardsModel extends Model
{
    protected $table = 'headboards';
    protected $primaryKey = 'id_headboards';
    protected $fillable =[
        'id_referencia',
        'id_patient',
        'total'
    ];

    /*public function referencia(){
        return $this->belongsTo('App\ReferenciaModel');
    }
    public function patient(){
        return $this->belongsTo('App\PatientModel');
    }*/
    

}
