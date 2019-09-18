@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.partials.sidebar-client')
        </div>
        <div class="col-md-8">
            <div class="card" id="information-form-container">
                <div class="card-header">Personal Information</div>

                <div class="card-body">
                    @sharedAlerts

                    <form action="{{ route('forms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row" id="personal-information-form-container">
                            @include('forms.create.personal_information')
                        </div>

                        <div class="form-row" id="spouse-information-form-container">
                            @include('forms.create.spouse_information')
                        </div>

                        <div class="form-row" id="contact-person-in-case-of-emergency-information-form-container">
                            @include('forms.create.contact_person_in_case_of_emergency')
                        </div>

                        <div class="form-row" id="attachments-form-container">
                            @include('forms.create.attachments')
                        </div>

                        <button type="button" id="previous-form-btn" class="btn btn-primary btn-lg">Previous</button>
                        <button type="button" id="next-form-btn" class="btn btn-primary btn-lg">Next</button>
                        <button type="submit" id="submit-form-btn" class="btn btn-primary btn-lg">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        jQuery(document).ready(function ($) {
            $('#sidebar-menu a:first-child').trigger('click');
        });
    </script>
@endsection