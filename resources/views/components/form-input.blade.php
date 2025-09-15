@props([
    'name',
    'type' => 'text',
    'label' => null,
    'value' => null,
    'required' => false,
    'placeholder' => '',
    'help' => null,
    'options' => [],
    'multiple' => false,
    'rows' => 3
])

@php
    $id = 'input_' . str_replace(['[', ']'], ['_', ''], $name);
    $classes = 'form-control';
    if ($errors->has($name)) {
        $classes .= ' is-invalid';
    }
@endphp

<div class="mb-3">
    @if($label)
    <label for="{{ $id }}" class="form-label">
        {{ $label }}
        @if($required)
        <span class="text-danger">*</span>
        @endif
    </label>
    @endif

    @switch($type)
        @case('select')
            <select name="{{ $name }}" id="{{ $id }}" class="{{ $classes }}" {{ $required ? 'required' : '' }} {{ $multiple ? 'multiple' : '' }}>
                @if(!$multiple && !$required)
                <option value="">Seleccionar...</option>
                @endif
                @foreach($options as $optionValue => $optionText)
                <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>
                    {{ $optionText }}
                </option>
                @endforeach
            </select>
            @break

        @case('textarea')
            <textarea name="{{ $name }}" id="{{ $id }}" class="{{ $classes }}" rows="{{ $rows }}" 
                placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}>{{ old($name, $value) }}</textarea>
            @break

        @case('email')
            <input type="email" name="{{ $name }}" id="{{ $id }}" class="{{ $classes }}" 
                value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}>
            @break

        @case('password')
            <input type="password" name="{{ $name }}" id="{{ $id }}" class="{{ $classes }}" 
                placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}>
            @break

        @case('number')
            <input type="number" name="{{ $name }}" id="{{ $id }}" class="{{ $classes }}" 
                value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} step="0.01">
            @break

        @case('date')
            <input type="date" name="{{ $name }}" id="{{ $id }}" class="{{ $classes }}" 
                value="{{ old($name, $value) }}" {{ $required ? 'required' : '' }}>
            @break

        @default
            <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" class="{{ $classes }}" 
                value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}>
    @endswitch

    @if($help)
    <div class="form-text">{{ $help }}</div>
    @endif

    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
