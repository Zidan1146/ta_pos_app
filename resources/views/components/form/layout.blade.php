<form action="{{ route("$viewPath.$operation", $urlParameter) }}" method="POST" class="d-flex flex-column w-100 gap-4">
    @csrf
    {{ $extra ?? '' }}

    {{ $slot }}
</form>
