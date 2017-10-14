<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
  protected $table = "OrderLine";
  protected $primarykey ='id_orderLine';
  public $timestamps=true;

  public function shoes(){
		return $this->belongsTo('\App\Models\Shoes','id_shoes');  
	}

  public function order(){
		return $this->hasMany('\App\Models\Order','id_order');  
	}

}