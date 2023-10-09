<table class="table table-bordered">
    <thead>
        <tr>
            <th>SL No.</th>
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ ++$sl }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td class="d-flex">
                    <a href="" class="me-1 btn btn-primary btn-sm showBtn" data-bs-toggle="modal"
                        data-bs-target="#showModal" data-id="{{ $task->id }}" data-name="{{ $task->name }}"
                        data-description="{{ $task->description }}"><i class="fa-solid fa-eye"></i></a>
                    <a data-bs-toggle="modal" data-bs-target="#updateModal" href="" data-id="{{ $task->id }}"
                        data-name="{{ $task->name }}" data-description="{{ $task->description }}"
                        class="btn btn-info btn-sm me-1 editBtn">
                        <i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="" data-id="{{ $task->id }}" data-name="{{ $task->name }}"
                        data-description="{{ $task->description }}" class="btn btn-danger btn-sm deleteBtn">
                        <i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $tasks->links() }}
