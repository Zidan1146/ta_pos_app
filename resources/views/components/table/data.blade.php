@foreach ($dataModel as $model)
    <tr class="text-center">
        <td>{{ $loop->iteration }}</td>
        @foreach ( $model->getFillable() as $attribute)
            @if (in_array($attribute, ['id', 'uuid']) && !(isset($isIdShown) && $isIdShown))
                @continue
            @elseif (strcmp($attribute, 'password') === 0)
                <td>???</td>
                @continue
            @endif
            <td>{{ $model[$attribute] }}</td>
        @endforeach
        <td class="d-flex justify-content-between">
            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#editModal-{{ $loop->index }}">Edit</button>
            <form action="{{ route("$viewPath.delete", ['id' => $model->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </td>
    </tr>
@endforeach
