@extends('ui.mainpage')

@section('content')

<div class="card col-sm-8 mx-auto">
    <div class="card-header">
        <div class="h5">Update Current Location</div>
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success" role="alert" style="margin-top: 10px; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('driverLocation.update', $driver->user_id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="location" class="mb-2"> Current Location</label>
                <input type="text" name="location" class="form-control">
                @if ($errors->has('location'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="latitude" class="mb-2">Location Latitude</label>
                <input type="text" name="latitude" class="form-control">
                @if ($errors->has('latitude'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('latitude') }}</div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="longitude" class="mb-2">Location Longitude</label>
                <input type="phone" name="longitude" class="form-control">
                @if ($errors->has('longitude'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('longitude') }}</div>
                @endif
            </div>
            <div style="margin-top: 20px;">
                <a href="{{ route('driverLocation.show', $driver->user_id) }}" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection