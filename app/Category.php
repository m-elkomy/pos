<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Category extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'categories';
    protected $guarded=[];
    public $translatedAttributes = ['name'];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
