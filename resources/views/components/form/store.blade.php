@if (isset($isGenerated) && $isGenerated)
    <x-form.layout
        :viewPath="$viewPath"
        operation="store"
        :urlParameter="null">
        <x-form.generator
            :inputTypeConfig="$inputTypeConfig"
            :rowCount="$rowCount"
            :model="$model"
            :isUpdate="false"/>

        <div class="container d-flex justify-content-center ">
            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary px-4 py-2">
        </div>

    </x-form.layout>
@else
    <x-form.layout
    :viewPath="$viewPath"
    operation="store"
    :urlParameter="null">
        {{ $slot }}
        <div class="container d-flex justify-content-center ">
            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary px-4 py-2">
        </div>
    </x-form.layout>
@endif
