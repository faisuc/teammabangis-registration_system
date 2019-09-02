@foreach ($contactPersonInformation as $input)
    <div class="form-group col-md-6">
        @if ($input['category'] == 'input')
            <label for="{{ $input['id'] }}">{{ $input['label'] }}</label>
            <input type="{{ $input['type'] ?? 'text' }}" class="form-control" id="{{ $input['id'] }}" name="{{ $input['id'] }}" placeholder="{{ $input['label'] }}" value="{{ $input['value'] ??'' }}" autocomplete="off">
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