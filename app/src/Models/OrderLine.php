<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
  protected $table = "OrderLine";
  protected $primarykey ='id';
  public $timestamps=true;

  public function shoes(){
		return $this->belongsTo('\App\Models\Shoes','id_shoes');  
	}

  public function order(){
		return $this->belongsTo('\App\Models\Order','id_order');  
	}

}