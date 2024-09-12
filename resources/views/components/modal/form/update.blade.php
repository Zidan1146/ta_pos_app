@if (isset($isGenerated) && $isGenerated)
    <x-modal.form.layout
        :viewPath="$viewPath"
        operation="update"
        :urlParameter="$urlParameter"
        :iteration="$iteration"
        :item="$item">

        <x-slot name="extra">
            @method('PUT')
        </x-slot>

        <x-form.generator
            :inputTypeConfig="$inputTypeConfig"
            :model="$model"
            :rowCount="$rowCount"
            :isUpdate="true"/>

    </x-modal.form.layout>

@else
    <x-form.layout
        :viewPath="$viewPath"
        operation="update"
        :urlParameter="$urlParameter"
        :iteration="$iteration"
        :item="$item">

        <x-slot name="extra">
            @method('PUT')
        </x-slot>

        {{ $slot }}
    </x-form.layout>
@endif
