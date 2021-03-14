<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
	// fillable data column
	protected $fillable = [
	'product_id', 'attribute', 'value'
	];

}
