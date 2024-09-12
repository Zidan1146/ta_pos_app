@php
    $id = "editModal-$iteration";
    $label = "edit".ucfirst($item);
    $titleId = "editModalLabel";
    $title = "Edit ".ucfirst($item);
@endphp

<x-modal.layout
    :id="$id"
    :label="$label"
    :titleId="$titleId"
    :title="$title">
    {{ $slot }}
</x-modal.form.layout>

