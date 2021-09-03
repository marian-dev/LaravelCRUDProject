<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarDrivers;

class Cars extends Model
{
    use HasFactory;

    public function drivers(){
        return $this->belongsToMany(Drivers::class,'car_drivers', 'car_id','driver_id');
    }
}
