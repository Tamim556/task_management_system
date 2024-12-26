<x-backend.layouts.master>


    <main class="container-custom">
        <div class="col-md-10 ms-sm-auto col-lg-10">

            <div class="ps-3 mt-3">
                <div class="d-flex align-items-center">
                    <h2>Task Details</h2>
                    <span class="material-symbols-outlined ms-auto" style="font-size: 32px; margin-right: 16px;">
                        account_circle
                    </span>
                </div>
                
                
                <hr />
                
 
                <div style="" class="px-5">
                    <br>
 
                    <div class="row">

                        <div class="col-md-7">
    
                          <b>Title</b> 
                
                            <div>
                                {{$task->title}}
    
                            </div>
    
                            <br>

                            <b>Body</b> 


                            {!! $task->task_body !!}

                            <b>Created By</b>

                            <div>
                                {{ @$task->user->name }}

                            </div>

                            <br>

                            <b>Due Date</b> 

                            <div>
                                {{$task->due_date}}

                            </div>
    
                               
                        </div>
                
                        <div class="col-md-5 px-5 mb-5">
    
                            <div>
    
                                <img  src="{{ asset('storage/task-image/' . $task->image) }}"
                                                    class="img-fluid mx-auto d-block" alt="Image 1"
                                                   >
    
    
                            </div>
                
                
                        </div>
    
    
    
                        
                
                
                    </div>
 
               
                </div>
 
            </div>

           
        </div>

    </main>



   







</x-backend.layouts.master>