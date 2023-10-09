<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AJAX Laravel CRUD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />

    </head>

    <body>
        <div class="alert">

        </div>
        <div class="container">
            <h1 class="text-center mt-5">AJAX Laravel CRUD</h1>
            <div class="row">
                <div class="col-md-12 my-4 d-flex justify-content-end">
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#taskModal">Add
                        Task</button>
                </div>
            </div>
            <input type="text" name="search" id="search" class="form-control mb-3"
                placeholder='Search task.....'>
            <div class="table-data">

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
                                        data-bs-target="#showModal" data-id="{{ $task->id }}"
                                        data-name="{{ $task->name }}" data-description="{{ $task->description }}"><i
                                            class="fa-solid fa-eye"></i></a>
                                    <a data-bs-toggle="modal" data-bs-target="#updateModal" href=""
                                        data-id="{{ $task->id }}" data-name="{{ $task->name }}"
                                        data-description="{{ $task->description }}"
                                        class="btn btn-info btn-sm me-1 editBtn">
                                        <i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="" data-id="{{ $task->id }}" data-name="{{ $task->name }}"
                                        data-description="{{ $task->description }}"
                                        class="btn btn-danger btn-sm deleteBtn">
                                        <i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tasks->links() }}
            </div>
        </div>

        {{-- task modal --}}
        @include("tasks.modals.task_create_modal")
        @include("tasks.modals.task_edit_modal")
        @include("tasks.modals.task_show")

        {{-- task modal end --}}

        @include("tasks.partials.scripts")

    </body>

</html>
