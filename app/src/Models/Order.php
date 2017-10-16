<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $table = "Order";
  protected $primarykey ='id_order';
  public $timestamps=true;

  public function orderLine(){
		return $this->hasMany('\App\Models\OrderLine','id_orderLine');  
	}

  public function user(){
		return $this->belongsTo('\App\Models\User','id_user');  
	}

}