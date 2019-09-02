@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('layouts.partials.sidebar-admin')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Add New User <a href="{{ route('admin.users.index') }}" class="btn btn-secondary float-right">List of Users</a></div>

                <div class="card-body">
                    @sharedAlerts
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="roles">Roles</label>
                            <select class="form-control form-control-lg js-select2" name="roles[]" id="roles">
                                <option value="">Choose...</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ (old('roles') !== null && in_array($role->id, old('roles'))) ? 'selected' : '' }}
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
                                        {{ (old('project_managers') !== null && in_array($projectManager->id, old('project_managers'))) ? 'selected' : '' }}
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
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="verify_user" id="verify_user" {{ old('verify_user') ? 'checked' : '' }}>
                            <label class="form-check-label" for="verify_user">Verify user</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg mt-3">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection