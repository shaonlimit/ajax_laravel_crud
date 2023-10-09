<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <form action="" method="POST" id="taskForm">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="taskModalLabel">Add Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="text" name="name" id="name" class="form-control" placeholder='Enter title'>
                    <div class="nameError mb-3">

                    </div>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                        placeholder="Enter description"></textarea>
                    <div class="descriptionError">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary addTaskBtn">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
