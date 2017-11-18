<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table = "User";
  protected $primarykey ='id';
  public $timestamps=true;


  public function orders(){
		return $this->hasMany('\App\Models\Order');  
	}
}