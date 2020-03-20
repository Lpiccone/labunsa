<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = 'analysis_category';
    protected $primaryKey = 'id_analysis_category';
    protected $fillable =[
        'name_category'
    ];
    public $timestamps = false;
}
