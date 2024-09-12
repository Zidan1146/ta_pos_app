@php
    $model = $dataModel[0] ? $dataModel[0] : $dataModel;
@endphp
<table class="table table-hover">
    <tr class="text-center">
        <th>No</th>
        @foreach ( !$dataModel->isEmpty() ? $model->getFillable() : []  as $attribute)

            @if (in_array($attribute, ['id', 'uuid']) && !(isset($isIdShown) && $isIdShown))
                @continue
            @endif
            <th>{{ ucfirst($attribute) }}</th>
        @endforeach
        <th>Action</th>
    </tr>
    {{ $data }}
</table>
