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
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Ride ID</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                // get current page for Paginator
                $currentPage = (\Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage() - 1) * 10;
                @endphp
                @foreach($payments as $key => $payment)
                <tr>
                    <td>{{ $currentPage + $key + 1 }}</td>
                    <td>{{Auth::user()->name }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>{{ $payment->ride_id}}</td>
                    <td>
                        <form action="{{ route('payment.destroy', $payment->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('payment.show', $payment->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn-primary"><i class="fa fa-pen"></i></a>      
                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection