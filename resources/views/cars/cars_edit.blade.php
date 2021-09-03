@extends('templates.main')

@section('content')
<h1>Car management</h1>
<div class="row mb-5">
    <div class="col-12">
    <a href="{{route('cars.index')}}" class="btn btn-success">Go back</a>
    </div>
</div>
<form method="POST" action="{{ route('cars.update', $car->id) }}">
    @csrf
    @method('PUT')
    <div class="row" style="align-items:flex-end;">
        <div class="col-3">
        <div class="form-group">
            <label for="model">Car Model</label>
            <input name="model" value="{{$car->model}}" type="text" class="form-control @error('model') is-invalid @enderror" id="model" aria-describedby="model" value="{{ old('model') }}">
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
            <input name="plate_number" value="{{$car->plate_number}}" type="text" class="form-control @error('plate_number') is-invalid @enderror" id="plate_number" aria-describedby="plate_number" value="{{ old('plate_number') }}">
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
            <input name="color" value="{{$car->color}}" type="text" class="form-control @error('color') is-invalid @enderror" id="color" aria-describedby="color" value="{{ old('color') }}">
            @error('color')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        </div>
        <div class="col-3 flex align-items-end">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit car</button>
            </div>
        </div>
    </div>
</form>

@endsection