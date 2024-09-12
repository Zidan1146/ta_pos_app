@foreach ($inputTypeConfig as $type => $typeAttributes)
    @php
        $attributes = is_array($inputTypeConfig[$type]) ? array_keys($typeAttributes) : [];
    @endphp
    @if (in_array($attribute, $attributes) && strcmp($type, 'select') === 0)
        <select name="{{ $attribute }}" id="{{ $attribute }}" class="form-select">
            @foreach ($typeAttributes as $key => $options)
                @foreach ($options as $option)
                    <option value="{{ $option }}">{{ ucfirst($option) }}</option>
                @endforeach
            @endforeach
        </select>
        <label for="{{ $attribute }}">{{ ucfirst($attribute) }}</label>
        @break
    @elseif(in_array($attribute, $attributes) && strcmp($type, 'textarea') === 0)
        @foreach($typeAttributes as $key => $data)
            @if (strcmp($key, $attribute) === 0)
                <textarea name="{{ $attribute }}" id="{{ $attribute }}" cols="{{ $data[0] }}" max-cols="{{ $data[1] }}" class="form-control" placeholder="">{{ $isUpdate ? $model[$attribute] : '' }}</textarea>
            @endif
        @endforeach
        <label for="{{ $attribute }}">{{ ucfirst($attribute) }}</label>
        @break
    @elseif(in_array($attribute, $typeAttributes))
        <input type="{{ $type }}"
            name="{{ $attribute }}" id="{{ $attribute }}"
            value="{{ $isUpdate && strcmp($attribute, 'password') !== 0 ? $model[$attribute] : '' }}"
            placeholder=""
            class="form-control">
        <label for="{{ $attribute }}">{{ ucfirst($attribute) }}</label>
        @break
    @elseif ($loop->last)
        <input type="text"
            name="{{ $attribute }}" id="{{ $attribute }}"
            value="{{ $isUpdate ? $model[$attribute] : '' }}"
            placeholder=""
            class="form-control">
        <label for="{{ $attribute }}">{{ ucfirst($attribute) }}</label>
        @break
    @endif
@endforeach
