<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserv extends Model
{
    //
    protected $fillable=[
        "good_id",
        "couponcode",
        "address",
        "price"
    ];
}
