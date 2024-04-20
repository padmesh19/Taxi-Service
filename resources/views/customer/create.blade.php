@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Customer</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
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
                        <form action="/customer" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Customer Name</label>
                                <input type="text" name="name" class="form-control">
                                @if ($errors->has('name'))
                                    <div class="text-danger"
                                         style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Customer Email</label>
                                <input type="email" name="email" class="form-control">
                                @if ($errors->has('email'))
                                    <div class="text-danger"
                                         style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Select Roles</label>
                                <select class="form-control" name="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                    <div class="text-danger"
                                         style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('role_id') }}</div>
                                @endif
                            </div>
                            <div style="margin-top: 20px;">
                                <a href="{{ route('customer.index') }}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection