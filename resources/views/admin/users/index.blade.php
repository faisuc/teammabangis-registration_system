@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('layouts.partials.sidebar-admin')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Users <a href="{{ route('admin.users.create') }}" class="btn btn-secondary float-right">Add New</a></div>

                <div class="card-body">
                    @sharedAlerts
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Name</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Verified</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                    <td>{{ $user->hasVerifiedEmail() ? 'Yes' : 'No' }}</td>
                                    <td><a href="{{ route('admin.users.edit', ['user' => $user]) }}" class="btn btn-outline-secondary" role="button">Edit</a> <a href="#" class="btn btn-outline-danger" onclick="event.preventDefault(); var r = confirm('Are you sure?');  if (r) { document.getElementById('delete-user-form-{{ $user->id }}').submit(); }">Delete</a>
                                        <form action="{{ route('admin.users.destroy', ['user' => $user]) }}" id="delete-user-form-{{ $user->id }}" method="post" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No users</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection