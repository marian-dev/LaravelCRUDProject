@extends('templates.main')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<h1>Update information for {{ $driver->name }}</h1>
<div class="row mb-5">
    <div class="col-12">
    <a href="{{route('drivers.index')}}" class="btn btn-success">Go back</a>
    </div>
</div>
<form method="POST" action="{{ route('drivers.update', $driver->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row" style="align-items:flex-end;">
        <div class="col-4">
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" value="{{ $driver->name }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" value="{{ old('name') }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label for="gender"> Gender</label>
                <input name="gender" value="{{ $driver->gender }}" type="text" class="form-control @error('gender') is-invalid @enderror" id="gender" aria-describedby="gender" value="{{ old('gender') }}">
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-4">
        <div class="form-group">
            <label for="address">Adress</label>
            <input name="address" value="{{ $driver->address }}" type="text" class="form-control @error('address') is-invalid @enderror" id="address" aria-describedby="address" value="{{ old('address') }}">
            @error('address')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="picture">Profile picture</label>
                <input name="picture" type="file" class="form-control @error('picture') is-invalid @enderror" id="picture" aria-describedby="picture" value="{{ old('picture') }}">
                @error('picture')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label for="licence_type"> Licence type</label>
                <input name="licence_type" value="{{ $driver->licence_type }}" type="text" class="form-control @error('licence_type') is-invalid @enderror" id="licence_type" aria-describedby="licence_type" value="{{ old('licence_type') }}">
                @error('licence_type')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-2">
           <div class="form-group" style="position:relative;">
                <label for="licence_date">Driver licence obtained on</label>
                <input name="licence_date" value="{{ $driver->licence_date }}" type="text" class="date form-control @error('licence_date') is-invalid @enderror" id="licence_date" aria-describedby="licence_date" value="{{ old('licence_date') }}">
                @error('licence_date')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-4 flex align-items-end">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update information</button>
            </div>
        </div>
    </div>
</form>

@endsection
@section('after_scripts')
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function() {
           $('.date').datepicker({changeYear: true, yearRange: "1900:2021", dateFormat: "yy-mm-dd"});
        });
    </script>    
@endsection