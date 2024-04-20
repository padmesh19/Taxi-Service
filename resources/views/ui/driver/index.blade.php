@extends('ui.mainpage')

@section('content')


<div class="card mb-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div> <i class="fas fa-solid fa-user"></i>
                Drivers
            </div>
            <div>
                <a href="{{ route('driver.create') }}" class="text-decoration-none">
                    <i class="fas fa-user-plus"></i>
                    Create
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th colspan="2">Action</th>
                </tr>
            </tfoot>
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
                        @can('customers.write')
                        <form action="{{ route('driver.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('driver.show', $user->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('driver.edit', $user->id) }}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></a>
                        </form>
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
@endsection