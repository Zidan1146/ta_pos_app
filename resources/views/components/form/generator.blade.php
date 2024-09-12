@php
    // $inputTypeConfig = $inputTypeConfig ?: [
    //     // Model attribute that needs types of input other than text
    //     // type => [attr: strings]
    //     // --------------------------------------------------
    //     // example:
    //     // 'email' => ['email']
    //     // --------------------------------------------------
    //     // result:
    //     // <input type="email" name="email" id="email" value="value" class="form-control">
    //     // <label for="email">Email</label>
    //     // --------------------------------------------------

    //     'email' => [],
    //     'number' => [],
    //     'password' => [],
    //     'date' => [],
    //     'datetime' => [],
    //     'hidden' => [],
    //     'tel' => [],

    //     // Model attribute that needs types of select
    //     // type => [
    //     //      attr => [options]
    //     // ]
    //     // --------------------------------------------------
    //     // example:
    //     // 'select' => [
    //     //      'gender' => ['male', 'female']
    //     // ]
    //     // --------------------------------------------------
    //     // result:
    //     // <select class="form-control" name="gender" id="gender" placeholder="">
    //     //      <option value="male">Male</option>
    //     //      <option value="female">Female</option>
    //     // </select>
    //     // <label for="gender">Gender</label>
    //     // --------------------------------------------------

    //     'select' => [],
    //     // Model attribute that needs types of select
    //     // type => [
    //     //      attr => [min-col, max-col]
    //     // ]
    //     // --------------------------------------------------
    //     // example:
    //     // 'textarea' => [
    //     //      'address' => [10, 12]
    //     // ]
    //     // --------------------------------------------------
    //     // result:
    //     // <textarea name="address" class="form-control" id="address" cols="10" max-cols="12" placeholder=""></textarea>
    //     // --------------------------------------------------
    //     //
    //     'textarea' => []

    // ];

    $attributes= $model->getFillable();

@endphp

@foreach ($attributes as $attribute)
    @if ($loop->index === 0)
        <div class="container d-flex w-100 justify-content-between gap-3">
    @endif

    @if (in_array($attribute, ['id', 'uuid']))
        @continue
    @endif

    <div class="form-floating w-50">
        <x-form.generator_inner_loop
            :inputTypeConfig="$inputTypeConfig"
            :attribute="$attribute"
            :isUpdate="$isUpdate"
            :model="$model"/>
    </div>

    @if (($loop->index % $rowCount) === 0)
        </div>
        <div class="container d-flex w-100 justify-content-between gap-3">
    @endif
@endforeach
