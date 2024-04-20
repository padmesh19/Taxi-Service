@extends('ui.mainpage')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('ride.edit',  $rideRequest->id) }}"><i class="fas fa-pen"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ride.index') }}"><i class="fas fa-home"></i></a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    View Ride Details
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <p>Name : {{$rideRequest->name}}</p>

                    <p>Customer ID : {{$rideRequest->user_id}}</p>

                    <p>Mobile : {{$rideRequest->phone}}</p>

                    <p>Pick Up Point : {{$rideRequest->pickup}}</p>

                    <p>Drop Point : {{$rideRequest->destination}}</p>

                    <p>Pick Up Time : {{$rideRequest->pickTime}}</p>

                    <p>Distance : {{$rideRequest->distance}}</p>

                    <p>Amount : {{$rideRequest->amount}}</p>

                    <p>Driver ID : {{$rideRequest->driver_id}}</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection