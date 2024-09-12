@if (isset($isGenerated) && $isGenerated)
    <x-modal.form.layout
        :viewPath="$viewPath"
        operation="update"
        :urlParameter="$urlParameter"
        :iteration="$iteration"
        :item="$item">

        <x-form.generator
            :inputTypeConfig="$inputTypeConfig"
            :model="$model"
            :rowCount="$rowCount"
            :isUpdate="false"/>

    </x-modal.form.layout>

@else
    <x-form.layout
        :viewPath="$viewPath"
        operation="update"
        :urlParameter="$urlParameter"
        :iteration="$iteration"
        :item="$item">
        {{ $slot }}
    </x-form.layout>
@endif
