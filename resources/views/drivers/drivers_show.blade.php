@extends('templates.main')

@section('content')
<h1>Extended info on {{$driver->name}}</h1>

<div class="row">
    <div class="col-12">
        <div class="card mt-2" style="flex-direction: row;padding:5px;">
            <img src="/{{$driver->picture}}" class="card-img-top img-thumbnail" style="width: 15%;" />
            <div class="card-body">
                <h5 class="card-title">{{$driver->name}}</h5>
                <p>Gender: {{$driver->gender}}</p>
                <p>Address: {{$driver->address}}</p>
                <p>Driver licence: {{$driver->licence_type}}</p>
                <p>Since: {{$driver->licence_date}}</p>
                <p>
                    <a class="btn btn-sm btn-primary" href="{{route('drivers.index')}}">Go back</a>
                </p>
            </div>
        </div>
    </div>
</div>


@endsection