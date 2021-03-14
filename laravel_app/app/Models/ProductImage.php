<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    // fillable data column
	protected $fillable = [
	'product_id', 'image'
	];

	    /**
     * @param $value
     * @return string
     */
	    public function getImageAttribute($value)
	    {
	    	return url('product_image').'/'.$value;	    	
	    }
	}
