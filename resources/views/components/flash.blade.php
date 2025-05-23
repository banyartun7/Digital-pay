@props(['name'])
@error($name)
    <div class="text-center alert alert-danger">{{ $message }}</div>
@enderror
