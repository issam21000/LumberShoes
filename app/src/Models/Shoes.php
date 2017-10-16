<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoes extends Model
{
  protected $table = "Shoes";
  protected $primarykey ='id_shoes';
  public $timestamps=true;
  
  public function brand(){
		return $this->belongsTo('\App\Models\Brand','id_brand');  
	}

  public function orderLine(){
		return $this->hasMany('\App\Models\OrderLine','id_orderLine');  
	}

  public function shop(){
		return $this->belongsTo('\App\Models\Shop','id_shop');  
	}

}