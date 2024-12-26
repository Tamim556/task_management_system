<nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block bg-white sidebar collapse sidebar-width shadow-lg"
style="height: 100vh; position: fixed;">
<div class="d-flex justify-content-center align-items-center flex-column mt-2 pb-3">
<div class="mb-2">



    <h4 class="mt-2">{{ Auth::user()->name }}</h4>


    {{-- <img src="{{ asset('template/news_site/images/logo.png') }}" alt="image" class="profile-img" style="
                        margin-top: 16px;
    " /> --}}
</div>
</div>
    <div style="overflow-y: auto; height: 65vh" class="scrollbar-none">
    <ul class=" list-unstyled px-3 mt-4 gap-4">
        <li class="mb-4 d-flex align-items-center">
        <i class="bi bi-speedometer2 fs-5 me-2" style="color: #898e99"></i>
        
        <a href="" class="text-decoration-none menu_size text-black align-items-center">
        Dashboard
        </a>
        </li>

        <li class="mb-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-cart fs-5 me-2" style="color: #898e99;"></i>
                <div class="d-flex w-100 justify-content-between">
                <a id="menu-click" 
                    class="text-decoration-none text-black menu_size bold align-items-center collapsed d-flex justify-content-between" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#product-collapse" 
                    aria-expanded="false" 
                    style="width: 100%;
                            height: 37px;
                            flex-shrink: 0;
                            border-radius: 5px;
                            background: #f0f0f0;">
                    <span style="cursor: pointer;">tasks</span>
                    <i id="product-icon" class="bi bi-chevron-left"></i>
                </a>
            </div>
            
            </div>

            <div class="collapse" id="product-collapse">
                <ul class="btn-toggle-nav pb-1 bold-text ">
                <li class="ms-4 py-1 mt-2" style="">
                    <a href="{{route('admin.task.index')}}" class="text-black sub_menu_size text-decoration-none">All tasks</a>
                </li>

                <li class="ms-4 py-1 mt-2" style="">
                    <a href="{{route('admin.task.create')}}" class="text-black sub_menu_size text-decoration-none">Add task</a>
                </li>

             

             

                </ul>

            </div>
        </li>
       


        <li class="mb-4 d-flex align-items-center">
            <i class="bi bi-door-open-fill me-2 fs-4" style="color: #898e99"></i>
            <a href="#" 
               class="text-decoration-none menu_size text-black bold align-items-center" 
               style="cursor: pointer"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </li>
        
        <form id="logout-form" method="post" action="{{ route('logout') }}" style="display: none;">
            @csrf
        </form>
        
    </div>
    </li>
    </ul>
</nav>