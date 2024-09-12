@php
    $label = 'null';
    $titleId = 'null';
@endphp

<x-form.layout
    :viewPath="$viewPath"
    :operation="$operation"
    :urlParameter="$urlParameter">
    {{ $extra ?? '' }}
    @if ((isset($isEditMode) && $isEditMode) || !isset($isEditMode))
        <x-modal.layout_edit
            :iteration="$iteration"
            :item="$item">
                {{ $slot }}
        </x-modal.layout_edit>
    @else
        <x-modal.layout
            :id="$id"
            :label="$label"
            :titleId="$titleId"
            :title="$title">
            {{ $slot }}
        </x-modal.form.layout>
    @endif
</x-form.layout>
