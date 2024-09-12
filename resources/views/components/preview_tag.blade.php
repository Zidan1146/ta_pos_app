@php
    $secondaryHeader = null;
    $secondaryBody = null;
@endphp
<div class="alert alert-info ">
    <h1>{{ $header }}</h1>
    {{ $body }}
    <h2>{{ $secondaryHeader ?: '' }}</h2>
    {{ $secondaryBody ?: '' }}
</div>
