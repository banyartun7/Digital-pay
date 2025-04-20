@props(['name', 'type' => 'text'])
<div class="form-group mb-3">
    <label for="{{ $name }}" class="mb-2">{{ ucwords($name) }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name) }}" class="form-control"
        id="{{ $name }}" placeholder="Enter {{ $name }}">
</div>
<x-error :name="$name" />
