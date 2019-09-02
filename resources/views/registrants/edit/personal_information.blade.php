@foreach ($personalInformation as $key => $input)
    <div class="form-group col-md-6">
        @if ($input['category'] == 'input')
            @if ($key == 'email')
                <label for="{{ $input['id'] }}">{{ $input['label'] }}</label>
                <input type="{{ $input['type'] ?? 'text' }}" class="form-control" id="{{ $input['id'] }}" name="{{ $input['id'] }}" placeholder="{{ $input['label'] }}" value="{{ $registrant->email }}" autocomplete="off" {{ isset($input['readonly']) ? 'readonly' : '' }}>
            @else
                <label for="{{ $input['id'] }}">{{ $input['label'] }}</label>
                <input type="{{ $input['type'] ?? 'text' }}" class="form-control" id="{{ $input['id'] }}" name="{{ $input['id'] }}" placeholder="{{ $input['label'] }}" value="{{ $registrant->personalInformation->{getTextInsideBrackets($input['id'])} }}" autocomplete="off" {{ isset($input['readonly']) ? 'readonly' : '' }}>
            @endif
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
            $('select[name="personal_information[project_sites][]"]').val({{ $registrant->projectSites->pluck('id')[0] }});
            $('select[name="personal_information[project_sites][]"]').trigger('change');
            $('select[name="personal_information[area_managers][]"]').prop('disabled', true);
            setTimeout(function () {
                $('select[name="personal_information[area_managers][]"]').val({{ $registrant->areaManagers->pluck('id')[0] }});
                $('select[name="personal_information[area_managers][]"]').prop('disabled', false);
            }, 2000);

            $('select[name="personal_information[civil_status]"]').val({{ $registrant->personalInformation->civil_status }});
        });
    </script>
@endsection