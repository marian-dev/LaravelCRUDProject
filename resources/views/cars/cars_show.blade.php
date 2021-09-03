@extends('templates.main')

@section('content')
<h1>Extended info on {{$car->plate_number}}</h1>

<div class="row">
    <div class="col-12">
        <div class="card mt-2">
            <div class="card-body">
                <p>Model: {{$car->model}}</p>
                <p>Color: {{$car->color}}</p>
                <p>Plate number: {{$car->plate_number}}</p>
                @if(isset($drivers_count))
                    <p>
                        The car has <b>{{ $drivers_count }}</b> drivers assigned.
                    </p>
                @endif
                <!--<p>Date purchased: {{$car->date_purchased}}</p>-->
                <p>
                    <a class="btn btn-sm btn-primary" href="{{route('cars.index')}}">Go back</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <p>
        <h5>Driver selection</h5>
    </p>
    <div class="col-12">
        <form method="GET" action="{{ route('cars.show', $car->id) }}">
            <div class="row" style="align-items:flex-end;">
                <div class="col-3">
                    <div class="form-group">
                        <label for="name">Search by name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" value="{{ isset($name_filter) ? $name_filter : '' }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="gender_filter">Gender Filter</label>
                        <select name="gender_filter"  class="form-control" id="gender_filter">
                            <option value="all" {{ ( isset($gender_filter) && $gender_filter == "all") ? 'selected' : '' }}>All genders</option>
                            @foreach($genders as $gender)
                                <option value="{{ $gender->gender }}" {{ ( isset($gender_filter) && $gender_filter == $gender->gender) ? 'selected' : '' }}>{{ $gender->gender }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="licence_type_filter">Licence Type Filter</label>
                        <select name="licence_type_filter"  class="form-control" id="licence_type_filter">
                            <option value="all" {{ ( isset($licence_type_filter) && $licence_type_filter == "all") ? 'selected' : '' }}>All types</option>
                            @foreach($licence_types as $licence)
                                <option value="{{ $licence->licence_type }}" {{ ( isset($licence_type_filter) && $licence_type_filter == $licence->licence_type) ? 'selected' : '' }}>{{ $licence->licence_type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2 flex align-items-end">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Apply filters</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@if (isset($drivers))
<p></p>
<div class="row flex-row">
   
        @foreach($drivers as $driver)
        <div class="col-4">
            <div class="card mt-2" style="flex-direction: row;padding:5px;">
            <img src="/{{$driver->picture}}" class="card-img-top img-thumbnail" style="width: 35%;" />
                <div class="card-body">
                    <h5 class="card-title">{{$driver->name}}</h5>
                    <p>Address: {{$driver->address}}</p>
                    <p></p>
                    <p>
                        <form method="POST" action="{{ route('cars.assign', ['car_id'=>$car->id, 'driver_id'=>$driver->id]) }}">
                            @csrf
                            
                            <button type="submit" class="btn btn-sm btn-danger">Assign to car</button>
                        </form>
                    </p>
                </div>
            </div>
            </div>
        @endforeach
    
</div>
@endif
@endsection