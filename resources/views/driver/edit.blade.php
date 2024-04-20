@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}"><i
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
                            <div class="alert alert-success" role="alert"
                                 style="margin-top: 10px; margin-bottom: 10px;">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="/user/{{$user->id}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for=""> User Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                    <div class="text-danger"
                                         style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">User Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                @if ($errors->has('email'))
                                    <div class="text-danger"
                                         style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Select Roles</label>
                                <select class="form-control" name="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {!! in_array($role->id, $user->roles()->pluck('id')->toArray(), true) ? 'selected' : '' !!}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                    <div class="text-danger"
                                         style="margin-top: 10px; margin-bottom: 10px;">{{ $errors->first('role_id') }}</div>
                                @endif
                            </div>
                            <div style="margin-top: 20px;">
                                <a href="{{ route('user.index') }}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
