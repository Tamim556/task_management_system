<x-backend.layouts.master>

   
    <main class="container-custom">
        <div class="col-md-10 ms-sm-auto col-lg-10">
            <!-- main content section starts here -->
            <div class="ps-3 ">
                <h2 class="px-4 my-3">Add New Task</h2>
                <hr />
                <div style="box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.10)" class="px-lg-4 px-2">
                    <br>

                    <div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.task.store') }}" id="taskStoreFrom" method="post">
                                        @csrf
                                        <input type="hidden" name="main_image" id="main_image" value="">
                                        <input type="hidden" name="draft" id="draft" value="">
                                        <div class="mb-4">
                                            <label for="">Task Title</label>
                                            <input type="text" id="title" name="title"
                                                class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Head Line"
                                                style="height: 50px;">
                                        </div>
                                        <span class="text-danger error-text title_error"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-8">
                                    <h1 class="mt-3 custom-bg">
                                        Description
                                    </h1>
                                    <div class="mb-2 w-100 mb-4 mt-4">
                                        <textarea class="w-100" rows="4" name="task_body" id="task_body"></textarea>
                                    </div>
                                    <span class="text-danger error-text task_body_error"></span>
                                    <div class="d-flex mb-4 justify-content-between">
                                        <div class="">
                                            <button type="submit" id="draftButton"
                                                class=" py-2 px-2 custom-hover-btn btn  border border-black custom-shadow">
                                                Save Draft
                                            </button>
                                        </div>
                                        <div class="">
                                            <button type="submit" style="background-color: #606BD0; color:white"
                                                class=" py-2 px-3 custom-hover-btn btn  border border-black custom-shadow">
                                                Publish
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4 mb-5">
                                    <h1 class="mt-3 custom-bg">
                                        Status
                                    </h1>
                                    <select class="form-control w-100" id="status" name="status">
                                        <option value="" selected disabled>Select status</option>
                                        <option value="assin">assin</option>

                                        <option value="pending">Pending</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                      </select>
                                      <span class="text-danger error-text status_error"></span>
                                      <h1 class="mt-3 custom-bg">
                                        Due Date
                                    </h1>
                                    <input type="date" name="due_date" class="form-control w-100"
                                    placeholder="Select Due Date" />
                                      <span class="text-danger error-text due_date_error"></span>
                                    <h1 class="mt-3 custom-bg">
                                        Task Image
                                    </h1>
                                    <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" type="button"
                                        setatt class="btn btn-outline-primary">Set Image</button>

                                    <span class="text-danger error-text main_image_error"></span>
                                    <div id="image_div" style="display: none">
                                        <img id="selected-image" height=""
                                            src="https://wearecardinals.com/wp-content/uploads/2020/04/u1Re9qgMfM8d6kumlW85PS6s55jQh5fbdmppgQsP.jpeg"
                                            class="img-fluid mt-3 mb-3" alt="...">

                                    </div>

                                </div>
                            </div>
                            </form>
                        </div>

                    </div>
                    <!-- main content section ends here -->



                </div>







                <!-- Start Image off canvus -->

                <div class="offcanvas offcanvas-bottom pb-5" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel"
                    data-image-type="main" style="height: 900px; overflow-y: auto;">
                    <div id="imageDiv">
                        <div class="offcanvas-header" style="height: 70px;background-color: #f0f0f0;">
                            <h5 class="offcanvas-title w-100" id="offcanvasBottomLabel"
                                style="font-size: 24px;font-weight: 600;">Media Files</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="mx-3 my-3" style="font-size: 18px;font-weight: 600;">
                            Recently uploaded files
                        </div>
                        <div class="row  d-flex mx-4">
                            <div class="col-md-7 mb-3 ">
                                <div class="d-flex gap-3 justify-content-between">
                                    @foreach (App\Models\TaskImage::orderBy('id', 'desc')->take(3)->get() as $task_image)
                                    <div class="position-relative col-4 custom-div" 
                                         data-image-name="{{ $task_image->name }}" 
                                         style="background: #FFF; box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.15); height: 200px; display: flex; align-items: end;">
                                        <img onclick="selectImage('{{ asset('storage/task-image/' . $task_image->name) }}','{{ $task_image->name }}')" 
                                             src="{{ asset('storage/task-image/' . $task_image->name) }}" 
                                             alt="img" class="img-fluid w-100" style="height: 100%;">
                                        <div class="position-absolute w-100 py-1 px-3"
                                             style="bottom: 0; background: #FFF; box-shadow: 0px -4px 10px 0px rgba(0, 0, 0, 0.10); font-size: 14px;">
                                            Image Name
                                            <div style="font-size: 14px;">
                                                jpeg
                                            </div>
                                            <div class="position-absolute tick-mark" style="display: none;">✓</div>
                                        </div>
                                    </div>
                                @endforeach
                            
                                </div>
                            </div>

                            <!--Start Image Upload -->
                            <div class="col-md-5" style="display: flex;justify-content: end;">
                                <div class=""
                                    style="display: flex;justify-content: center;align-items: center ;border: 4px dashed #606BD0;background: #FFF;height: 200px;width: 90%;">
                                    <div class="container mt-5">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <div class="custom-file mb-3">
                                                    <form action="{{ route('admin.image.upload') }}" method="post"
                                                        id="imageStoreFrom" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="file" name="image" class=""
                                                            id="image" accept="image/*">
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            file</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                                <span class="text-danger error-text image_error"></span>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Image Upload -->
                        </div>

                        <div class="px-3 my-3 w-100"
                            style="font-size: 18px;font-weight: 600; background-color: #f0f0f0; height: 70px;display: flex;align-items: center; justify-content:space-between;">
                            Previously uploaded files
                            <div>
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    placeholder="Search for..." style="border: none;">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button"
                                                        style="border-radius: 5px; background: #E0E0E0; border: none;color: #000;">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mx-5 mb-5">
                            <div class="row gap-4  " style="justify-content: space-between;">

                                @foreach (App\Models\TaskImage::orderBy('id', 'desc')->get() as $task_image)
                 <div class="position-relative col-2 p-0 custom-div"
                     style="background: #FFF; box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.15); height: 200px; display: flex; align-items: end;">
                     <img onclick="selectImage('{{ asset('storage/task-image/' . $task_image->name) }}','{{ $task_image->name }}')" 
                         src="{{ asset('storage/task-image/' . $task_image->name) }}"
                         alt="img" class="img-fluid w-100" style="height: 100%;">
                     <div class="position-absolute w-100 py-1 px-3"
                         style="bottom: 0; background: #FFF; box-shadow: 0px -4px 10px 0px rgba(0, 0, 0, 0.10); font-size: 14px;">
                         Image Name
                         <div style="font-size: 14px;">
                             jpeg
                         </div>
                         <div class="position-absolute tick-mark">✓</div>

                     </div>
                 </div>
                              @endforeach

                                <div class="position-relative col-2 p-0"
                                    style="background: #FFF; box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.15); height: 200px; display: flex; align-items: end;">
                                    <img src="images/34685692.jpg" alt="img" class="img-fluid w-100"
                                        style="height: 100%;">
                                    <div class="position-absolute w-100 py-1 px-3"
                                        style="bottom: 0; background: #FFF; box-shadow: 0px -4px 10px 0px rgba(0, 0, 0, 0.10); font-size: 14px;">
                                        Image Name
                                        <div style="font-size: 14px;">
                                            jpeg
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <div class=" d-flex justify-content-center fixed-bottom mb-3">
                                <div class=" d-flex justify-content-center"
                                    style="border-radius: 5px; background: #38AF00;width: 25%;">
                                    <button data-bs-dismiss="offcanvas" aria-label="Close" class="py-2 btn w-100"
                                        style=" color: white; font-size: 20px;">Select</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Image off canvus -->


            </div>
            <!-- add category Model ends here -->







    </main>



    @push('page_scripts')
        @include('backend.task.js.create_page_js')
    @endpush





</x-backend.layouts.master>
