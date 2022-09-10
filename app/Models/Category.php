<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use Translatable;
    // use \Dimsav\Translatable\Translatable;
    protected $with = ['translations'];
    protected $guarded = [];
    public $translatedAttributes = ['name'];
    use HasFactory;
    public function products()
    {
        return $this->hasMany(Product::class);

    }//end of products
}
