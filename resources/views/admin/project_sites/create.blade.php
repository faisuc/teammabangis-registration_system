@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('layouts.partials.sidebar-admin')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Add New Project Site <a href="{{ route('admin.project-sites.index') }}" class="btn btn-secondary float-right">List of Project Sites</a></div>

                <div class="card-body">
                    @sharedAlerts
                    <form action="{{ route('admin.project-sites.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Enter description" rows="5">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="area_managers">Area Managers</label>
                            <select class="form-control form-control-lg js-select2" name="area_managers[]" id="area_managers" multiple>
                                <option value="">Choose...</option>
                                @foreach ($areaManagers as $areaManager)
                                    <option
                                        value="{{ $areaManager->id }}"
                                        {{ (old('area_managers') !== null && in_array($areaManager->id, old('area_managers'))) ? 'selected' : '' }}
                                    >
                                        {{ $areaManager->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg mt-3">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection