@extends('ui.mainpage')

@section('content')


<div class="card col-sm-8 mx-auto">
    <div class="card-header">
        <div class="h5">Create Customer</div>
    </div>
    <div class="card-body">
        <form action="{{ route('customer.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="mb-2">Customer Name</label>
                <input type="text" name="name" class="form-control">
                @if ($errors->has('name'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="email" class="mb-2">Customer Email</label>
                <input type="email" name="email" class="form-control">
                @if ($errors->has('email'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="phone" class="mb-2">Phone Number</label>
                <input type="text" name="phone" class="form-control">
                @if ($errors->has('phone'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('phone') }}</div>
                @endif
            </div>

            <div style="margin-top: 20px;">
                <a href="{{ route('customer.index') }}" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection