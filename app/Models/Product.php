<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    
    use Translatable;
    // use \Dimsav\Translatable\Translatable;
    protected $with = ['translations'];
    use HasFactory;
    protected $guarded = ['id'];

    public $translatedAttributes = ['name', 'description'];
    protected $appends = [ 'profit_percent'];


    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);

    }//end of image path attribute

    public function getProfitPercentAttribute()
    {

        if($this->purchase_price != 0) {
            $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent, 2);
        } else {
            // echo "Can not divide by zero!!";
        }
       

    }//end of get profit attribute

    public function category()
    {
        return $this->belongsTo(Category::class);

    }//end fo category

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order');

    }//end of orders

}//end of model

