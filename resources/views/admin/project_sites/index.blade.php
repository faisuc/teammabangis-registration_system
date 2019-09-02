@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('layouts.partials.sidebar-admin')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Project Sites <a href="{{ route('admin.project-sites.create') }}" class="btn btn-secondary float-right">Add New</a></div>

                <div class="card-body">
                    @sharedAlerts
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projectSites as $projectSite)
                                <tr {!! $projectSite->areaManagers->count() ? 'style="background-color: aliceblue;"' : '' !!}>
                                    <td>{{ $projectSite->name }}</td>
                                    <td>{{ $projectSite->theDescription }}</td>
                                    <td>{{ $projectSite->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.project-sites.edit', ['project_site' => $projectSite]) }}" class="btn btn-outline-secondary" role="button">Edit</a>
                                        <a href="#" class="btn btn-outline-danger" onclick="event.preventDefault(); var r = confirm('Are you sure?');  if (r) { document.getElementById('delete-projectsite-form-{{ $projectSite->id }}').submit(); }">Delete</a>
                                        <form action="{{ route('admin.project-sites.destroy', ['project_site' => $projectSite]) }}" id="delete-projectsite-form-{{ $projectSite->id }}" method="post" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No project sites.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $projectSites->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection