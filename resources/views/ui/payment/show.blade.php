@extends('ui.mainpage')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @can('payments.write')
                        <li class="breadcrumb-item"><a href="{{ route('payment.edit',  $payment->id) }}"><i class="fas fa-pen"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('payment.destroy', $payment->id) }}"><i class="fas fa-trash" style="color: red;"></i></a></li>
                        @endcan
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
                    View Payment Details
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <p>Name : {{$payment->id}}</p>

                    <p>Amount : {{$payment->amount}}</p>

                    <p>Time Taken : {{$payment->total_time}} Mins</p>

                    <p>Status : {{$payment->status}}</p>

                    <p>Ride Id : {{$payment->ride_id}}</p>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection