@foreach ($contactPersonInformation as $input)
    <div class="form-group col-md-6">
        @if ($input['category'] == 'input')
            <label for="{{ $input['id'] }}">{{ $input['label'] }}</label>
            <input type="{{ $input['type'] ?? 'text' }}" class="form-control" id="{{ $input['id'] }}" name="{{ $input['id'] }}" placeholder="{{ $input['label'] }}" value="{{ $registrant->contactPersonInCaseOfEmergency->{getTextInsideBrackets($input['id'])} }}" autocomplete="off">
        @elseif ($input['category'] == 'select')
            <label for="{{ $input['id'] }}">{{ $input['label'] }}</label>
            <select id="{{ $input['id'] }}" class="form-control {{ $input['class'] ?? '' }}" name="{{ $input['id'] }}">
                <option selected value="">Choose...</option>
                @foreach ($input['options'] as $key => $value)
                    <option
                        value="{{ $key }}"
                        {{ isset($selectedKey) && $selectedKey == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        @endif
    </div>
@endforeach

@section('js')
    @parent
    <script>
        jQuery(document).ready(function ($) {
            $('select[name="contact_person_in_case_of_emergency[frequency_of_owners_stay]"]').val({{ $registrant->contactPersonInCaseOfEmergency->frequency_of_owners_stay }});
            $('select[name="contact_person_in_case_of_emergency[area_involved_with_the_association]"]').val({{ $registrant->contactPersonInCaseOfEmergency->area_involved_with_the_association }});
        });
    </script>
@endsection