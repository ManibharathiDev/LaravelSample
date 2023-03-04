<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    use HasFactory;
	protected $fillable = [
         'order_id','item','uom','quantitty','price','discount','value'
      ];
}
