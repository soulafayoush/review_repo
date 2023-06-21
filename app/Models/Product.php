<?php

namespace App\Models;

use App\Http\Controllers\products\ProductController;
<<<<<<< HEAD
=======
use App\Models\Review;
>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['product_name','desc','price'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

<<<<<<< HEAD
    public function reviews()
=======
    public function review()
>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a
    {
        return $this->hasMany(Review::class);
    }

<<<<<<< HEAD
    public function order()
    {
        return $this->belongsToMany(Order::class);
    }


}
=======
}
>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a
