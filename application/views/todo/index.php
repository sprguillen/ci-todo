<section class="main-container">
    <div class="card card-center">
        <h5 class="card-header center-text">Simple TODO</h5>
        <div class="card-body">
            <section>
                <form class="form-inline" id="task-form">
                    <input type="hidden" name="task-id" />
                    <input type="text" class="form-control col-md-8 col-sm-7 col-12" name="task-name" placeholder="Task name" />
                    <button class="btn btn-primary col-md-3 col-sm-3 offset-md-1 offset-sm-2 col-12" id="add-btn">Add</button>
                    <button class="btn btn-primary col-md-3 col-sm-3 offset-md-1 offset-sm-2 col-12" id="edit-btn">Edit</button>
                </form>
            </section>
            <section class="mt-2">
                <div class="row bg-info todo-row">
                </div>
            </section>
        </div>
    </div>
</section>