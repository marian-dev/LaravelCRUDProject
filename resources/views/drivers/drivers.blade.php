@extends('templates.main')

@section('content')
<h1>Drivers management</h1>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<form method="POST" action="{{ route('drivers.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row" style="align-items:flex-end;">
        <div class="col-4">
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" value="{{ old('name') }}">
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
                <input name="gender" type="text" class="form-control @error('gender') is-invalid @enderror" id="gender" aria-describedby="gender" value="{{ old('gender') }}">
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
            <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" aria-describedby="address" value="{{ old('address') }}">
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
                <input name="licence_type" type="text" class="form-control @error('licence_type') is-invalid @enderror" id="licence_type" aria-describedby="licence_type" value="{{ old('licence_type') }}">
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
                <input name="licence_date" type="text" class="date form-control @error('licence_date') is-invalid @enderror" id="licence_date" aria-describedby="licence_date" value="{{ old('licence_date') }}">
                @error('licence_date')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-4 flex align-items-end">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add driver</button>
            </div>
        </div>
    </div>
</form>
<p></p>
<form method="GET" action="{{ route('drivers.index') }}">
<div class="row p-2 border" style="align-items:flex-end;">
    <div class="col-sm">
        <div class="form-group">
            <label for="licence_type_filter">Licence Type Filter</label>
            <select name="licence_type_filter"  class="form-control" id="licence_type_filter">
                <option value="all" {{ ( $licence_type_filter == "all") ? 'selected' : '' }}>All types</option>
                @foreach($licence_types as $licence)
                    <option value="{{ $licence->licence_type }}" {{ ( $licence_type_filter == $licence->licence_type) ? 'selected' : '' }}>{{ $licence->licence_type }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm">
        <div class="form-group">
            <label for="gender_filter">Gender Filter</label>
            <select name="gender_filter"  class="form-control" id="gender_filter">
                <option value="all" {{ ( $gender_filter == "all") ? 'selected' : '' }}>All genders</option>
                @foreach($genders as $gender)
                    <option value="{{ $gender->gender }}" {{ ( $gender_filter == $gender->gender) ? 'selected' : '' }}>{{ $gender->gender }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-4 flex align-items-end">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Apply filter</button>
        </div>
    </div>
</div>
</form>

<p></p>
<div class="row">
    <div class="col-12">
        @foreach($drivers as $driver)
            <div class="card mt-2" style="flex-direction: row;padding:5px;">
            <img src="{{$driver->picture}}" class="card-img-top img-thumbnail" style="width: 15%;" />
                <div class="card-body">
                    <h5 class="card-title">{{$driver->name}}</h5>
                    <p>Address: {{$driver->address}}</p>
                    <p></p>
                    <p>
                        <form method="POST" action="{{route('drivers.destroy', $driver->id)}}">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-sm btn-success mr-4" href="{{route('drivers.show', $driver->id)}}">Show</a>
                            <a class="btn btn-sm btn-primary" href="{{route('drivers.edit', $driver->id)}}">Edit</a>
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>

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