<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  protected $table = "City";
  protected $primarykey ='id';
  public $timestamps=true;

  public function shop(){
		return $this->hasMany('\App\Models\Shop');  
	}

}