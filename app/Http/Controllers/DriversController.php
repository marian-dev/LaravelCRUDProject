<?php

namespace App\Http\Controllers;

use App\Models\Drivers;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDriverRequest;

class DriversController extends Controller
{
    public $data;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $licence_type_filter = $request->get('licence_type_filter');
        $gender_filter = $request->get('gender_filter');
        
        if($licence_type_filter != null || $gender_filter !=null){
            if ($licence_type_filter == "all" && $gender_filter == "all") {
                $drivers = Drivers::all();
            } else if($licence_type_filter !== "all" && $gender_filter !== "all") {
                $drivers = Drivers::all()->where('licence_type', '=', $licence_type_filter)
                    ->where('gender', '=', $gender_filter);
            } else if($licence_type_filter == "all") {
                $drivers = Drivers::all()->where('gender', '=', $gender_filter);
            } else {
                $drivers = Drivers::all()->where('licence_type', '=', $licence_type_filter);
            }
        } else {
            $drivers = Drivers::all();
        }


        $licence_types = Drivers::select('licence_type')->distinct()->get();
        $genders = Drivers::select('gender')->distinct()->get();

        $this->data['drivers'] = $drivers;
        $this->data['licence_types'] = $licence_types;
        $this->data['genders'] = $genders;
        $this->data['licence_type_filter'] = $licence_type_filter;
        $this->data['gender_filter'] = $gender_filter;

        return view('drivers.drivers', $this->data);
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

    public function store(CreateDriverRequest $request)
    {
        
        $drivers = new Drivers();
        $drivers->name = $request->input('name');
        $drivers->address = $request->input('address');
        
        if ($request->file('picture')){
            $path = $request->file('picture')->store('public/uploads');
            $path_array = explode("/", $path);
            array_shift($path_array);
            $drivers->picture = implode("/",$path_array);
        }
            
        $drivers->licence_type = $request->input('licence_type');
        $drivers->licence_date = $request->input('licence_date');
        
        $drivers->save();
        return redirect()->back()->with('message', 'New driver added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drivers  $drivers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $driver = Drivers::findOrFail($id);
        $this->data['driver'] = $driver;
        
        return view('drivers.drivers_show',$this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drivers  $drivers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = Drivers::findOrFail($id);
        $this->data['driver'] = $driver;
        
        return view('drivers.drivers_edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drivers  $drivers
     * @return \Illuminate\Http\Response
     */
    public function update(CreateDriverRequest $request, $id)
    {
        $driver = Drivers::findOrFail($id);
        $driver->name = $request->input('name');
        $driver->gender = $request->input('gender');
        $driver->address = $request->input('address');
        $driver->licence_type = $request->input('licence_type');
        $driver->licence_date = $request->input('licence_date');

        if($request->file('picture')){
            $path = $request->file('picture')->store('public/uploads');
            $path_array = explode("/", $path);
            array_shift($path_array);
            $driver->picture = implode("/",$path_array);
        }

        $driver->save();

        return redirect()->route('drivers.index')->with('message', 'Driver updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drivers  $drivers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = Drivers::findOrFail($id);
        $driver->delete();

        return redirect()->route('drivers.index')->with('message', 'Driver removed!');
    }
}
