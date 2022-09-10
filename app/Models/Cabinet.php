<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Laravel\Sanctum\HasApiTokens;


class Cabinet  extends Model
{
    // use Translatable;
    // // use \Dimsav\Translatable\Translatable;
    // protected $with = ['translations'];
    // protected $guarded = [];
    // public $translatedAttributes = [];
    // use HasFactory;
    // public function products()
    // {
    //     return $this->hasMany(Product::class);

    // }//end of products

    protected $fillable = [
        'description',
        'Cabinet',
        'Created_by',
        'departed',
    ];
    // protected $with = ['translations'];
    // public $translatedAttributes = ['name'];
}
