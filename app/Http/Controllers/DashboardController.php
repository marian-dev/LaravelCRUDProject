<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarDrivers;
use App\Models\Cars;
use App\Models\Drivers;

class DashboardController extends Controller
{
    public $data;

    public function index(){

        $result = array();
        $cars = Cars::all();
        foreach($cars as $car) {
           $result[] = array($car, $car->drivers);
        }

        
        $this->data['data'] = $result;

        return view('dashboard.dashboard', $this->data);
    }

    public function destroy($car_id, $driver_id){
        $res = CarDrivers::where('car_id','=',$car_id)->where('driver_id','=',$driver_id)->delete();

        return redirect()->route('dashboard.index')->with('message', 'Driver no longer assigned to car!');
    }
}



?>