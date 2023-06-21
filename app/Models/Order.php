<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
<<<<<<< HEAD

    protected $table = 'order';

    protected $fillable = [
        'product_id',
        'order_id',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }




=======
>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a
}
