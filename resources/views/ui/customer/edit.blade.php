@extends('ui.mainpage')

@section('content')
<div class="align-content-sm-end">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}"><i class="fas fa-home"></i></a></li>
    </ol>
</div>


<div class="card col-sm-8 mx-auto">
    <div class="card-header">
        <div class="h5">Edit Customer</div>
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success" role="alert" style="margin-top: 10px; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('customer.update',$user->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name" class="mb-2"> Customer Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                @if ($errors->has('name'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="email" class="mb-2">Customer Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                @if ($errors->has('email'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="phone" class="mb-2">Phone Number</label>
                <input type="phone" name="phone" class="form-control" value="{{ $user->phone }}">
                @if ($errors->has('phone'))
                <div class="text-danger" style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('phone') }}</div>
                @endif
            </div>
            <div style="margin-top: 20px;">
                <a href="{{ route('customer.index') }}" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection