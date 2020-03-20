<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalysisModel extends Model
{
    protected $table = 'analysis';
    protected $primaryKey = 'id_analysis';
    protected $fillable =[
        'id_analysis_category',
        'id_cash',
        'name_analysis',
        'description',
        'price'
    ];
    public $timestamps = true;
}
