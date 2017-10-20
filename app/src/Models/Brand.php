<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $table = "Brand";
  protected $primarykey ='id_brand';
  public $timestamps=true;

  public function shoes(){
		return $this->hasMany('\App\Models\Shoes','id_shoes');  
	}

}