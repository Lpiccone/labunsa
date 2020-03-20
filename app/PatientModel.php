<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientModel extends Model
{
    protected $table = 'patients';
    protected $primaryKey = 'id_patient';
    protected $fillable =[
        'name_patient',
        'last_name_patient',
        'doi',
        'phone',
        'date_birth',
        'gender',
        'nationality',
        'occupation',
        'email',
        'home_direction',
        'allergies'
    ];
    public $timestamps = true;
}
