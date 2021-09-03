@extends('templates.main')

@section('content')
<h1>Car management</h1>

<form method="POST" action="{{route('cars.store')}}">
    @csrf
    <div class="row" style="align-items:flex-end;">
        <div class="col-3">
        <div class="form-group">
            <label for="model">Car Model</label>
            <input name="model" type="text" class="form-control @error('model') is-invalid @enderror" id="model" aria-describedby="model" value="{{ old('model') }}">
            @error('model')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        </div>
        <div class="col-3">
        <div class="form-group">
            <label for="plate_number">Plate number</label>
            <input name="plate_number" type="text" class="form-control @error('plate_number') is-invalid @enderror" id="plate_number" aria-describedby="plate_number" value="{{ old('plate_number') }}">
            @error('plate_number')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        </div>
        <div class="col-3">
        <div class="form-group">
            <label for="color">Color</label>
            <input name="color" type="text" class="form-control @error('color') is-invalid @enderror" id="color" aria-describedby="color" value="{{ old('color') }}">
            @error('color')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        </div>
        <div class="col-3 flex align-items-end">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add car</button>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-12">
        @foreach($cars as $car)
            <div class="card mt-2">
                <div class="card-body">
                    <p>Model: {{$car->model}}</p>
                    <p>Plate number: {{$car->plate_number}}</p>
                    <!--<p>Date purchased: {{$car->date_purchased}}</p>-->
                    <p>
                        <form method="POST" action="{{route('cars.destroy', $car->id)}}">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-sm btn-success mr-4" href="{{route('cars.show', $car->id)}}">Show</a>
                            <a class="btn btn-sm btn-primary" href="{{route('cars.edit', $car->id)}}">Edit</a>
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection