<x-backend.layouts.master>




    <style>
        .button_p {
            margin: 0;
            line-height: 39px;
            color: rgb(255, 255, 255);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.30);
            margin: 0;
            line-height: 39px;
        }

        .button {
            width: 7%;
            height: 39px;
            flex-shrink: 0;
            border: none;
            border-radius: 100px;
            background: #606BD0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>




    <main class="container-custom">
        <div class="col-md-10 ms-sm-auto col-lg-10">


            <!-- main content section starts here -->
            <div class="ps-3 mt-3">
                <div class="d-flex align-items-center">
                    <h2 class="px-4 my-3">All Tasks</h2>
                    <span class="material-symbols-outlined ms-auto" style="font-size: 32px; margin-right: 16px;">
                        account_circle
                    </span>
                </div>
                <hr />

                <div style="box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.10)" class="px-5 py-3">

                    <div class="d-flex gap-3">
                        <div class="px-3"
                            style=" height: 32px; border-radius: 5px; border: 1px solid #2B2F67; background: #FFF; box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.10); display: flex; justify-content: center; align-items: center;">
                            All <b> ({{ App\Models\Task::count() }})</b>
                        </div>
                        <a class="btn" href="{{route('admin.task.create')}}">Create Task</a>

                       


                        <div class="d-flex"
                            style=" width: 230px; height: 32px; border-radius: 5px; border: 1px solid #2B2F67; background: #FFF; box-shadow: 0px 4px 11.6px 0px rgba(0, 0, 0, 0.10); align-items: center; margin-left: auto;">
                            <input type="text" placeholder="Search here...."
                                style="flex-grow: 1; border: none; outline: none; height: 100%; width: 70%;">
                            <button
                                style="width: 43px; height: 32px; border-radius: 0px 5px 5px 0px; background: #606BD0; border: none; cursor: pointer; display: flex; justify-content: center; align-items: center;">
                                <span class="material-symbols-outlined" style="color: white;">search</span>
                            </button>
                        </div>
                    </div>


                    <form action="{{ route('admin.task.search') }}" method="post">
                        @csrf
                        <div class="row py-3">

                            <div class="col-md-4 mb-3 d-flex gap-2">

                                <input type="date" name="date" class="form-control w-100 shadow"
                                    placeholder="Select Due Date" />

                                <select class="form-control w-100 shadow" id="status" name="status">
                                    <option value="">Select status</option>
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>


                            <button type="submit" class="col-md-2  button me-3 "
                                style="border-radius: 5px; background: #606BD0; height: 37px;">
                                <p class="button_p">Apply</p>
                            </button>

                    </form>



                </div>

                <div class="">
                    <div class="bg-white pb-4 mb-b">
                        <div class="table-responsive ">

                            <table class="table">
                                <thead class="custom-header-style">
                                    <tr>

                                        <th scope="col" class=" col-sm-6 col-md-5 col-lg-2">Title</th>
                                        <th scope="col" class=" col-sm-6 col-md-5 col-lg-5">Body</th>
                                        <th scope="col" class=" col-sm-4 col-md-2 col-lg-2">Due Date</th>
                                        <th scope="col" class=" col-sm-4 col-md-2 col-lg-2">Created By</th>
                                        <th scope="col" class=" col-sm-4 col-md-2 col-lg-2">Status</th>
                                        <th scope="col" class=" col-sm-4 col-md-2 col-lg-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Demo table content -->

                                    @foreach ($tasks as $task)
                                        <tr>

                                            <td class="">
                                                {{ $task->title }}
                                            </td>

                                            <td class="table_name">
                                                {!! $task->task_body !!}
                                            </td>

                                            <td class="table_status">
                                                {{ $task->created_at->format('d/m/Y') }}
                                            </td>
                                            <td class="table_status">
                                                {{ @$task->user->name }}
                                            </td>
                                            <td class="table_status">
                                                {{ $task->status }}
                                            </td>
                                            <td class="table_status">
                                                <div class="btn-group" id="stageButton">


                                                    <button style="border: none ;background: none;"
                                                        data-bs-toggle="dropdown" data-bs-display="static"
                                                        aria-expanded="false">
                                                        <span class="material-symbols-outlined">
                                                            more_vert
                                                        </span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-lg-end border-0 p-0 m-0">
                                                        <div class="rounded-2 text-white-on-hover"
                                                            style="border: 1px solid #d7dfe9">

                                                            <li class="d-flex align-items-center">
                                                                <a class="btn dropdown-item d-flex align-items-center"
                                                                    href="{{ route('admin.task.show', ['task' => $task->id]) }}">
                                                                    <span class="material-symbols-outlined"
                                                                        style="font-size: 18px; color: #352092;">
                                                                        visibility </span> View
                                                                </a>
                                                            </li>

                                                            <li class="d-flex align-items-center">
                                                                <a class="btn dropdown-item d-flex align-items-center"
                                                                    href="{{ route('admin.task.edit', ['task' => $task->id]) }}">
                                                                    <span class="material-symbols-outlined me-1"
                                                                        style="font-size: 18px; color: #606BD0;">
                                                                        border_color </span> Edit
                                                                </a>
                                                            </li>
                                                            <li class="d-flex align-items-center">



                                                                <form id="btndelete{{ $task->id }}"
                                                                    action="{{ route('admin.task.delete', ['task' => $task->id]) }}"
                                                                    method="post" style="display:inline">
                                                                    @csrf
                                                                    <button type="button" class="btn btn-sm mx-2"
                                                                        id="{{ $task->id }}"
                                                                        onclick="btnDelete(this, this.id)">
                                                                        <span class="material-symbols-outlined"
                                                                            style="font-size: 18px; color: #f02b3b;">delete</span>
                                                                        Delete
                                                                    </button>
                                                                </form>


                                                            </li>


                                                        </div>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Demo table content -->


                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>

            </div>
            <!-- main content section ends here -->

        </div>


        </div>






    </main>




    <script>
        function btnDelete(ev, id) {

            console.log(id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $('#btndelete' + id).submit();
                };
            });
        }
    </script>






</x-backend.layouts.master>
