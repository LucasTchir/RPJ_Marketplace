<div class="col sidebar border-end" id="sidebar" style="max-height: 100vh; overflow-y: auto;">
    <div class="d-flex flex-column pt-1">
        <div class="">
            <div class="navbar-search-sidebar" style="width: 80%; margin: 0 auto; display: none;">
                <form action="/home/search" class="d-flex px-4">
                    <input type="text" name="search" class="border form-control border-black rounded-start-5 box-shadow" 
                    style="font-size: 14px; height: 40px; border-radius: 5px 0 0 5px;" placeholder="Hľadať..." value="{{request("search")}}">
            
                    <button type="submit" class="btn border border-start-0 border-black rounded-end-5 px-3" 
                    style="border-radius: 0 5px 5px 0; height: 40px;"><i class="bi bi-search text-dark me-1"></i></button>
                </form>
            </div>

            <div class="d-flex justify-content-center align-items-center mt-3">
                @auth
                    <p class="mb-0 pe-2" style="font-size: 18px;">
                        Vitaj, <a href="/users/{{auth()->user()->username}}" class="link"><span class="mb-0 fw-semibold">{{auth()->user()->name}}</span>!</a>
                    </p>

                    <div class="d-flex align-items-center ps-2" style="cursor: pointer;">
                        <a href="/users/{{auth()->user()->username}}" class="link">
                            <span class="rounded-circle d-inline-block ms-2" style="width: 42px; height: 42px; overflow: hidden;">
                                <img class="w-100 h-100 object-fit-cover" src="{{auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('/images/blank-profile-picture.png')}}" alt="Profile">
                            </span>
                        </a>
                        
                        <form method="POST" action="/logout" class="ms-3 d-flex align-items-center">
                            @csrf
                            <button type="submit" class="btn d-flex align-items-center px-1 py-1">
                                <i class="bi bi-box-arrow-right fs-4" style="font-size: 18px;"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="/register" class="link pe-3">
                        <span class="border rounded-5 border-black d-flex justify-content-center align-items-center" style="min-width: 120px; padding: 6px 0 6px 0;">
                            Zaregistrovať
                        </span>
                    </a>
                        
                    <a href="/login" class="link ps-3">
                        <span class="border rounded-5 border-black bg-black d-flex justify-content-center align-items-center" style="min-width: 120px; padding: 6px 0 6px 0; color: white;">
                            Prihlásiť sa
                        </span>
                    </a>
                @endauth
            </div>

            <a href="/" class="sidebar-link link d-flex align-items-center ps-5">
                <span class="fs-3"><i class="bi bi-shop"></i></span>
    
                <span class="py-3 px-4">
                    <p class="mb-0" style="font-size: 18px;">Prehliadať</p>
                </span>
            </a>
    
            <a href="/home/notifications" class="sidebar-link link d-flex align-items-center ps-5">
                <span class="fs-3"><i class="bi bi-bell"></i></span>
    
                <span class="py-3 px-4">
                    <p class="mb-0" style="font-size: 18px;">Upozornenia</p>
                </span>
            </a>

            <a href="/home/sellers" class="sidebar-link link d-flex align-items-center ps-5">
                <span class="fs-3"><i class="bi bi-people"></i></span>
    
                <span class="py-3 px-4">
                    <p class="mb-0" style="font-size: 18px;">Predajcovia</p>
                </span>
            </a>

            @if (auth()->check() && auth()->user()->isAdmin())
                <a href="/dashboard" class="sidebar-link link d-flex align-items-center ps-5">
                    <span class="fs-3"><i class="bi bi-layout-text-window-reverse"></i></span>
        
                    <span class="py-3 px-4">
                        <p class="mb-0" style="font-size: 18px;">Ovladací panel</p>
                    </span>
                </a>
            @endif
        </div>

        <a href="/create" class="link border-0">
            <span class="rounded-5 mx-5 mb-4 mt-2 px-4 d-flex justify-content-center align-items-center bg-green" style="min-width: 120px; padding: 6px 0 6px 0; background-color: #d9f2ec;">
                Vytvoriť inzerát
            </span>
        </a>

        <h4 class="fw-bold mx-5" style="font-size: 25px; letter-spacing: 1px;"><i class="bi bi-tags me-2"></i>KATEGÓRIE</h4>

        @foreach ($categories as $category)
            <a href="/category/{{$category->id}}" class="sidebar-link link">
                <div class="py-2 px-5">
                    <span class="mb-0 ms-4" style="font-size: 20px;">{!!$category->icon!!}</span>
                    <span class="mb-0 ms-4" style="font-size: 18px;">{{$category->category_name}}</span>
                </div>
            </a>
        @endforeach
    </div>      
</div>