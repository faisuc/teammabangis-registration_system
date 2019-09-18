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

                    <form action="{{ route('registrant_information.update', ['registrant' => $registrant]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-row" id="personal-information-form-container">
                            @include('registrants.edit.personal_information')
                        </div>

                        <div class="form-row" id="spouse-information-form-container">
                            @include('registrants.edit.spouse_information')
                        </div>

                        <div class="form-row" id="contact-person-in-case-of-emergency-information-form-container">
                            @include('registrants.edit.contact_person_in_case_of_emergency')
                        </div>

                        <div class="form-row" id="attachments-form-container">
                            @include('registrants.edit.attachments')
                        </div>

                        <button type="button" id="previous-form-btn" class="btn btn-primary btn-lg">Previous</button>
                        <button type="button" id="next-form-btn" class="btn btn-primary btn-lg">Next</button>
                        <button type="submit" id="submit-form-btn" class="btn btn-primary btn-lg">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @parent
    <script>
        jQuery(document).ready(function ($) {
            $('#sidebar-menu a:first-child').trigger('click');
        });
    </script>
@endsection