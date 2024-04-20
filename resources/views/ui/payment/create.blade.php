@extends('ui.mainpage')

@section('content')


<div class="card col-sm-8 mx-auto">
    <div class="card-header">
        <div class="h5">Enter the Details</div>
    </div>
    <div class="card-body">
        <form action="{{ route('payment.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="mb-2">Total Time Taken for the Ride</label>
                <input type="text" name="totalTime" class="form-control" placeholder="In Minutes">
                @if ($errors->has('totalTime'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('totalTime') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="email" class="mb-2">Waiting Time</label>
                <input type="text" name="waitTime" class="form-control" placeholder="In Minutes">
                @if ($errors->has('waitTime'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('WaitTime') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="email" class="mb-2">Additional Charges if any</label>
                <input type="text" name="charge" class="form-control" placeholder="Breakage if any">
                @if ($errors->has('charge'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('charge') }}</div>
                @endif
            </div>

            <input type="hidden" name="rideId" value="{{$rideId}}">

            <div style="margin-top: 20px;">
                <a href="{{ route('customer.index') }}" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection