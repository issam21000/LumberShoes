<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $table = "Order";
  protected $primarykey ='id';
  public $timestamps=true;

  public function orderLine(){
		return $this->hasMany('\App\Models\OrderLine');  
	}

  public function user(){
		return $this->belongsTo('\App\Models\User','user_id');  
	}

}