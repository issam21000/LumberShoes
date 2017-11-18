<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoes extends Model
{
  protected $table = "Shoes";
  protected $primarykey ='id';
  public $timestamps=true;
  
  public function brand(){
		return $this->belongsTo('\App\Models\Brand','brand_id');  
	}


  public function orderLines(){
		return $this->hasMany('\App\Models\OrderLine');  
	}

  public function shop(){
		return $this->belongsTo('\App\Models\Shop','shop_id');
	}

}