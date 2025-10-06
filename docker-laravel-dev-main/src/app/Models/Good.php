<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    //
    protected $fillable=[
        "stor_id",
        "name",
        "price",
    ];
    public function stor(){
        return $this->belongsTo(Stor::class,"stor_id");
    }
}
