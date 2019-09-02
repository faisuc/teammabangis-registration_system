@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('layouts.partials.sidebar-admin')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Registrants</div>

                <div class="card-body">
                    @sharedAlerts
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($registrants as $registrant)
                                <tr>
                                    <td>{{ $registrant->email }}</td>
                                    <td>{{ $registrant->personalInformation->first_name . ' ' . $registrant->personalInformation->last_name }}</td>
                                    <td>{{ $registrant->created_at }}</td>
                                    <td>
                                        <a href="{{ route('registrant_information.show', ['reference_code' => $registrant->personalInformation->reference_code, 'email' => $registrant->email]) }}" class="btn btn-outline-secondary" role="button">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No registrants.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $registrants->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection