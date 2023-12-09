
@props(['id', 'value' => null])

<input {{ $attributes->merge(['class' => 'form-checkbox']) }} type="checkbox" id="{{ $id }}" value="{{ $value }}" />
