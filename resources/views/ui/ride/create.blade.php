@extends('ui.mainpage')

@section('content')


<div class="card col-sm-8 mx-auto">
    <div class="card-header">
        <div class="h5">Create Ride Request</div>
    </div>
    <div class="card-body">
        <form action="{{ route('ride.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="mb-2">Passenger Name</label>
                <input type="text" name="name" class="form-control">
                @if ($errors->has('name'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="phone" class="mb-2">Mobile</label>
                <input type="text" name="phone" class="form-control">
                @if ($errors->has('phone'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('phone') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="pickup" class="mb-2">Pick Up Point</label>
                <input type="text" name="pickup" class="form-control">
                @if ($errors->has('pickup'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('pickup') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="pickupLat" class="mb-2">Pick Up Point Latitude</label>
                <input type="text" name="pickupLat" class="form-control">
                @if ($errors->has('pickupLat'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('pickupLat') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="pickupLong" class="mb-2">Pic Up Point Longitude</label>
                <input type="text" name="pickupLong" class="form-control">
                @if ($errors->has('pickupLong'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('pickupLong') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="destination" class="mb-2">Drop Point</label>
                <input type="text" name="destination" class="form-control">
                @if ($errors->has('destination'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('destination') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="destinationLat" class="mb-2">Drop Point Latitude</label>
                <input type="text" name="destinationLat" class="form-control">
                @if ($errors->has('destinationLat'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('destinationLat') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="destinationLong" class="mb-2">Drop Point Longitude</label>
                <input type="text" name="destinationLong" class="form-control">
                @if ($errors->has('destinationLong'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('destinationLong') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="pickTime" class="mb-2">Pick Up Time</label>
                <input type="datetime-local" name="pickTime" class="form-control">
                @if ($errors->has('pickTime'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('pickTime') }}</div>
                @endif
            </div>

            <div style="margin-top: 20px;">
                <a href="{{ route('ride.index') }}" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection