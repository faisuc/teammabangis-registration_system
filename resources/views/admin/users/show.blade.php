@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('layouts.partials.sidebar-admin')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Profile <a href="{{ route('admin.users.edit', ['user' => $user]) }}" class="btn btn-secondary float-right">Edit Profile</a></div>

                <div class="card-body">
                    @sharedAlerts
                    <form action="{{ route('admin.users.update', ['user' => $user]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <h3>{{ $user->email }}</h3>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <h3>{{ $user->name }}</h3>
                        </div>
                        <div class="form-group">
                            <label for="roles">Roles</label>
                            <h3>{{ $user->roles->pluck('name')->implode(', ') }}</h3>
                        </div>
                        @hasrole('area-manager')
                            <div class="form-group">
                                <label for="project_managers">Project Managers</label>
                                <h3>{{ $user->projectManagers->pluck('name')->implode(', ') }}</h3>
                            </div>
                        @endhasrole
                        <div class="form-group">
                            <h3>{!! $user->hasVerifiedEmail() ? '<i class="fas fa-user-check"></i>' : '<i class="fas fa-times-circle"></i>' !!}</h3>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection