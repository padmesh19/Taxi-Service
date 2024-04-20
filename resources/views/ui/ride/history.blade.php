@extends('ui.mainpage')

@section('content')


<div class="card mb-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div> <i class="fas fa-solid fa-user"></i>
                Ride Requests
            </div>
            <div>
                <a href="{{ route('ride.create') }}" class="text-decoration-none">
                    <i class="fas fa-user-plus"></i>
                    Create
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Pickup Point</th>
                    <th>Drop Point</th>
                    <th>Distance</th>
                    <th>Pickup Time</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Driver</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                // get current page for Paginator
                $currentPage = (\Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage() - 1) * 10;
                @endphp
                @foreach($rideRequests as $key => $rideRequest)
                <tr>
                    <td>{{ $currentPage + $key + 1 }}</td>
                    <td>{{ $rideRequest->name }}</td>
                    <td>{{ $rideRequest->phone }}</td>
                    <td>{{ $rideRequest->pickup }}</td>
                    <td>{{ $rideRequest->destination }}</td>
                    <td>{{ $rideRequest->distance }} KM</td>
                    <td>{{ $rideRequest->pickTime }}</td>
                    <td>{{ $rideRequest->amount }}</td>
                    <td>{{ $rideRequest->status }}</td>
                    <td>{{ $rideRequest->driver_id }}</td>
                    <td>
                        @can('rides.write')
                        <form action="{{ route('ride.destroy', $rideRequest->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('ride.show', $rideRequest->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 10px;">
            {{ $rideRequests->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection