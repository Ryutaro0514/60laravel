<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stor extends Model
{
    //
    protected $fillable=[
        "name",
        "spot",
        "mail",
        "account",
        "password"
    ];
}
