<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable 
{   
    use HasApiTokens;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}
