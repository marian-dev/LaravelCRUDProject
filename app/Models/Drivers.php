<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarDrivers;

class Drivers extends Model
{
    use HasFactory;

    public function drivers(){
        return $this->belongsToMany(Cars::class,'car_drivers', 'car_id','driver_id');
    }
}
