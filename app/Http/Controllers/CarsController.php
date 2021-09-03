<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\CarDrivers;
use App\Models\Drivers;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCarRequest;
use App\Http\Requests\DriversCarRequest;

class CarsController extends Controller
{
    public $data;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Cars::all();

        $this->data['cars'] = $cars;
        return view('cars.cars', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCarRequest $request)
    {
        
        $cars = new Cars();
        $cars->model = $request->input('model');
        $cars->plate_number = $request->input('plate_number');
        $cars->save();

        return redirect()->back()->with('message', 'Masina a fost adaugata');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $car = Cars::findOrFail($id);
        $this->data['car'] = $car;

        $name_filter = $request->get('name');
        $licence_type_filter = $request->get('licence_type_filter');
        $gender_filter = $request->get('gender_filter');

        if ($licence_type_filter != "" || $gender_filter != "" || $name_filter != "") {
            $conditions = array();
            if($licence_type_filter != "" && $licence_type_filter != "all") {
                $conditions[] = array('licence_type', '=', $licence_type_filter);
            }
            if($gender_filter != "" && $gender_filter != "all") {
                $conditions[] = array('gender', '=', $gender_filter);
            }
            if($name_filter != "") {
                $conditions[] = array('name', 'like', '%'.$name_filter.'%');
            }
            $drivers = Drivers::select()->where($conditions)->get();
        } else {
            $drivers = Drivers::all();
        }

        $this->data['drivers'] = $drivers;
        $this->data['drivers_count'] = CarDrivers::where('car_id', '=', $id)->count();

        $genders = Drivers::select('gender')->distinct()->get();
        $licence_types = Drivers::select('licence_type')->distinct()->get();
        $this->data['genders'] = $genders;
        $this->data['name_filter'] = $name_filter;
        $this->data['licence_types'] = $licence_types;
        $this->data['licence_type_filter'] = $licence_type_filter;
        $this->data['gender_filter'] = $gender_filter;
        
        return view('cars.cars_show',$this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Cars::findOrFail($id);
        $this->data['car'] = $car;
        
        return view('cars.cars_edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCarRequest $request, $id)
    {
      $car = Cars::findOrFail($id);
      $car->model = $request->input('model');
      $car->plate_number = $request->input('plate_number');
      $car->color = $request->input('color');
      $car->save();

      return redirect()->route('cars.index')->with('message', 'Car updated!');
    }

    public function assign($car_id, $driver_id){
        $car = Cars::findOrFail($car_id);
        $this->data['car'] = $car;

        $carDriver = new CarDrivers();
        $carDriver->car_id = $car_id;
        $carDriver->driver_id = $driver_id;
        $carDriver->save();

        $genders = Drivers::select('gender')->distinct()->get();
        $licence_types = Drivers::select('licence_type')->distinct()->get();
        $this->data['genders'] = $genders;
        $this->data['licence_types'] = $licence_types;

        return redirect()->route('cars.show', $this->data)->with('message', 'Driver assigned');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Cars::findOrFail($id);
        $car->delete();

        return redirect()->route('cars.index')->with('message', 'Car deleted!');
    }
}
