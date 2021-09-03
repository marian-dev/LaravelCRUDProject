@extends('templates.main')

@section('content')
<h1>Dashboard</h1>

@foreach($data as $entry)

            <div class="card mt-2">
                <div class="card-body">
                    <p>Model: {{$entry[0]->model}}</p>
                    <p>Plate number: {{$entry[0]->plate_number}}</p>
                    <p>Color: {{$entry[0]->color}}</p>
                    <h5>Drivers</h5>
                    <div class="row flex-row">
                    @foreach($entry[1] as $driver)
                    <div class="col-4">
                    <div class="card mt-2" style="flex-direction: row;padding:5px;">
            <img src="{{$driver->picture}}" class="card-img-top img-thumbnail" style="width: 35%;" />
                <div class="card-body">
                    <h5 class="card-title">{{$driver->name}}</h5>
                    <p>Address: {{$driver->address}}</p>
                    <p>Licence type: {{$driver->licence_type}}</p>
                    <p></p>
                    <p>
                        <form method="POST" action="{{route('dashboard.destroy', ['car_id'=>$entry[0]->id,'driver_id'=>$driver->id] )}}">
                            @csrf
                            @method('DELETE')
                           <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </p>
                </div>
            </div>
</div>
                    @endforeach
</div>
                </div>
            </div>
    
@endforeach

@endsection