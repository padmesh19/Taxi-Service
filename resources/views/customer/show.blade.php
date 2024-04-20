@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Customer Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @can('customers.write')
                                <li class="breadcrumb-item"><a href="{{ route('customer.edit', $customer->id) }}"><i
                                            class="fas fa-pen"></i></a></li>
                                <li class="breadcrumb-item"><a href="#"
                                                               onclick="commonDelete(`{{ route('customer.destroy', $customer->id) }}`)"><i
                                            class="fas fa-trash" style="color: red;"></i></a></li>
                            @endcan
                            <li class="breadcrumb-item"><a href="{{ route('customer.index') }}"><i
                                        class="fas fa-home"></i></a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <p>Name : {{$customer->name}}</p>

                        <p>Email : {{$customer->email}}</p>

                        <p>Roles : @foreach($customer->roles as $role) {{$role->name}}@endforeach</p>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
