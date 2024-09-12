@if (isset($isGenerated) && $isGenerated)
    <x-form.layout
        :viewPath="$viewPath"
        operation="update"
        :urlParameter="$urlParameter">

        <x-slot name="extra">
            @method('PUT')
        </x-slot>

        <x-form.generator
            :inputTypeConfig="$inputTypeConfig"
            :model="$model"
            :rowCount="$rowCount"
            :isUpdate="true"/>
        <div class="container d-flex justify-content-center ">
            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary px-4 py-2">
        </div>

    </x-form.layout>

@else
    <x-form.layout
    :viewPath="$viewPath"
    operation="update"
    :urlParameter="$urlParameter">
        <x-slot name="extra">
            @method('PUT')
        </x-slot>
        {{ $slot }}
        <div class="container d-flex justify-content-center ">
            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary px-4 py-2">
        </div>
    </x-form.layout>
@endif
