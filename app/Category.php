<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;
use App\Category;

class Category extends Model
{
    use SoftDeletes;
    protected $guarded =[];
    protected $dates  =['deleted_at'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    //this concept is calleed pivot table selfjoin concept
    public function childrens()
    {
        return $this->belongsToMany(Category::class,'catagory_parent',
        'category_id','parent_id');
    }
}
