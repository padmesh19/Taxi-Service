@extends('ui.mainpage')

@section('content')
<div class="align-content-sm-end">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}"><i class="fas fa-home"></i></a></li>
    </ol>
</div>


<div class="card col-sm-8 mx-auto">
    <div class="card-header">
        <div class="h5">Edit Payment</div>
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success" role="alert" style="margin-top: 10px; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{route('payment.update', $payment->id) }}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="mb-2">Total Time Taken for the Ride</label>
                <input type="text" name="totalTime" class="form-control">
                @if ($errors->has('totalTime'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('totalTime') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="email" class="mb-2">Waiting Time</label>
                <input type="text" name="WaitTime" class="form-control">
                @if ($errors->has('waitTime'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('WaitTime') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="email" class="mb-2">Additional Charges if any</label>
                <input type="text" name="charge" class="form-control">
                @if ($errors->has('charge'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('charge') }}</div>
                @endif
            </div>

            <div style="margin-top: 20px;">
                <a href="{{ route('payment.index') }}" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection