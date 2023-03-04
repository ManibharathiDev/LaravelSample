<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
	protected $fillable = [
         'order_no','order_date','customer_no','customer_name'
      ];
	  
	public function items()
    {
        return $this->hasMany(\App\Models\ItemDetail::class);
    }
}
