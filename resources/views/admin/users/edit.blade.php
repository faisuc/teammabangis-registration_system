@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('layouts.partials.sidebar-admin')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Edit User
                    @can('create', $user)
                    <a href="{{ route('admin.users.create') }}" class="btn btn-secondary float-right clearfix">Add New User</a> <a href="{{ route('admin.users.index') }}" class="btn btn-secondary float-right clearfix mr-2">List of Users</a>
                    @endcan
                </div>

                <div class="card-body">
                    @sharedAlerts
                    <form action="{{ route('admin.users.update', ['user' => $user]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="roles">Roles</label>
                            <select class="form-control form-control-lg js-select2" name="roles[]" id="roles">
                                <option value="">Choose...</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}
                                    >{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="project_managers">Project Managers</label>
                            <select class="form-control form-control-lg js-select2" name="project_managers[]" id="project_managers" multiple>
                                <option value="">Choose...</option>
                                @foreach ($projectManagers as $projectManager)
                                    <option
                                        value="{{ $projectManager->id }}"
                                        {{ in_array($projectManager->id, $user->projectManagers->pluck('id')->toArray()) ? 'selected' : '' }}
                                    >
                                        {{ $projectManager->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                        </div>
                        @can('verify-user', $user)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="verify_user" id="verify_user" {{ $user->hasVerifiedEmail() ? 'checked' : '' }}>
                                <label class="form-check-label" for="verify_user">Verify user</label>
                            </div>
                        @endcan
                        <button type="submit" class="btn btn-primary btn-lg mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection