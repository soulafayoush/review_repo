<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
<<<<<<< HEAD
use App\Models\Order;
=======
>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function review()
    {
        return $this->hasMany(Review::class);
    }
<<<<<<< HEAD

    public function order()
    {
        return $this->hasMany(Order::class);
    }


=======
>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a
}
