@extends('ui.mainpage')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 align-items-sm-end">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('driverLocation.edit',  Auth::user()->id) }}">
                                <i class="fas fa-pen"></i></a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    View Current Location
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <p>Name : {{Auth::user()->name}}</p>

                    <p>Current Location : {{$driver->location}}</p>

                    <p>Latitude : {{$driver->latitude}}</p>

                    <p>Latitude : {{$driver->longitude}}</p>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection