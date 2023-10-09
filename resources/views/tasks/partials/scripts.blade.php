<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        //create
        $(document).on('click', '.addTaskBtn', function(e) {
            e.preventDefault();

            let name = $('#name').val();
            let description = $('#description').val();

            $.ajax({
                url: "{{ route("task.store") }}",
                method: 'POST',
                data: {
                    name: name,
                    description: description
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#taskModal').modal('hide');
                        $('#taskForm')[0].reset();
                        $('.table').load(location.href + ' .table');
                        $('.alert').empty();
                        $('.alert').append(`<p class='alert alert-success'>Task added</p>`)
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;


                    if (error.errors.name) {
                        $('.nameError').empty();
                        $('.nameError').append(
                            `<p class="text-danger">${ error.errors.name}</p>`
                        )
                    }
                    if (error.errors.description) {
                        $('.descriptionError').empty();
                        $('.descriptionError').append(
                            `<p class="text-danger">${ error.errors.description}</p>`
                        )
                    }

                }
            });
        })


        //edit
        $(document).on('click', '.editBtn', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let description = $(this).data('description');

            $('#update_id').val(id);
            $('#update_name').val(name);
            $('#update_description').val(description);
        });
        //update
        $(document).on('click', '.updateTaskBtn', function(e) {

            e.preventDefault();

            let id = $('#update_id').val();
            let name = $('#update_name').val();
            let description = $('#update_description').val();


            $.ajax({
                url: "{{ route("task.update") }}",
                method: 'POST',
                data: {
                    id: id,
                    name: name,
                    description: description
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#updateModal').modal('hide');
                        $('#updateForm')[0].reset();
                        $('.table').load(location.href + ' .table');
                        $('.alert').empty();
                        $('.alert').append(
                            `<p class='alert alert-success'>Task updated</p>`)
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;


                    if (error.errors.name) {
                        $('.nameError').empty();
                        $('.nameError').append(
                            `<p class="text-danger">${ error.errors.name}</p>`
                        )
                    }
                    if (error.errors.description) {
                        $('.descriptionError').empty();
                        $('.descriptionError').append(
                            `<p class="text-danger">${ error.errors.description}</p>`
                        )
                    }

                }
            });

        });
        //delete
        $(document).on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you to delete?')) {
                $.ajax({
                    url: "{{ route("task.delete") }}",
                    method: 'POST',
                    data: {
                        id: id,

                    },
                    success: function(res) {
                        if (res.status == 'success') {

                            $('.table').load(location.href + ' .table');
                            $('.alert').empty();
                            $('.alert').append(
                                `<p class='alert alert-danger'>Task deleted</p>`)
                        }
                    },

                });
            }

        })

        //show
        $(document).on('click', '.showBtn', function(e) {

            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            let description = $(this).data('description');


            $.ajax({
                url: "{{ route("task.show") }}",
                method: 'POST',
                data: {
                    id: id,
                    name: name,
                    description: description
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('.showModalTitle').empty();
                        $('.showModalTitle').append(
                            `<p>${ name}</p>`)
                        $('.showModalDescription').empty();
                        $('.showModalDescription').append(
                            `<p>${ description}</p>`)
                    }
                },

            });

        });
        //pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            task_pagination(page);
        })
        //pagination function
        function task_pagination(page) {
            $.ajax({
                url: "/pagination/paginate-data?page=" + page,
                success: function(res) {
                    $('.table-data').html(res);
                }
            })
        }
        //search task
        $(document).on('keyup', function(e) {
            e.preventDefault();
            let search_string = $('#search').val();
            // console.log(search_string);
            $.ajax({
                url: "{{ route("task.search") }}",
                method: 'GET',
                data: {
                    search_string: search_string
                },
                success: function(res) {
                    $('.table-data').html(res);
                    if (res.status == 'nothing_found') {
                        $('.table-data').html(
                            `<span class='text-danger'>Nothing Found</span>`)
                    }
                }
            })

        })
    });
</script>
