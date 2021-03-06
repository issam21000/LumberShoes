<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
  protected $table = "Shop";
  protected $primarykey ='id';
  public $timestamps=true;

  public function shoes(){
		return $this->hasMany('\App\Models\Shoes');  
	}


  public function city(){
		return $this->belongsTo('\App\Models\City','city_id');
	}

}