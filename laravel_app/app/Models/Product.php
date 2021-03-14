<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;

	// fillable data column
	protected $fillable = [
	'title', 'description', 'price','user_id'
	];

	// get single image for listing page
    /***
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function imageData()
    {
    	return $this->hasOne(ProductImage::class,'product_id')->select('image','product_id');
    }

   	// get all image for view page
    /***
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function allImage()
    {
    	return $this->hasMany(ProductImage::class,'product_id')->select('image','product_id');
    }

    // get all product attribute for view page
    /***
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function allAttributes()
    {
    	return $this->hasMany(ProductAttribute::class,'product_id')->orderBy('attribute');
    }

}
