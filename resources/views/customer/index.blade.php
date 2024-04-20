@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customers</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('customer.create') }}"><i
                                        class="fas fa-user-plus"></i></a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <div class="row justify-content-center">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        // get current page for Paginator
                        $currentPage = (\Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage() - 1) * 10;
                    @endphp
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ $currentPage + $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                <span>{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('customer.show', $user->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                @can('customers.write')
                                    <a href="{{ route('customer.edit', $user->id) }}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-danger" type="button" onclick="commonDelete(`{{ route('customer.destroy', $user->id) }}`)"><i class="fa fa-trash"></i></button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 10px;">
                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
