<div class="col sidebar border-end" id="sidebar">
    <div class="d-flex flex-column pt-1">
        <div class="">
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

            <a href="/dashboard/listings" class="sidebar-link link d-flex align-items-center ps-5">
                <span class="fs-3"><i class="bi bi-pencil-square"></i></span>
            
                <span class="py-3 px-4">
                    <p class="mb-0" style="font-size: 18px;">Spravovať Inzeráty</p>
                </span>
            </a>
            
            <a href="/dashboard/users" class="sidebar-link link d-flex align-items-center ps-5">
                <span class="fs-3"><i class="bi bi-person-gear"></i></span>
            
                <span class="py-3 px-4">
                    <p class="mb-0" style="font-size: 18px;">Spravovať Použivaťeľov</p>
                </span>
            </a>
            
            <a href="/dashboard/categories" class="sidebar-link link d-flex align-items-center ps-5">
                <span class="fs-3"><i class="bi bi-ui-checks-grid"></i></span>
            
                <span class="py-3 px-4">
                    <p class="mb-0" style="font-size: 18px;">Spravovať Kategórie</p>
                </span>
            </a>
        </div>

        <a href="/create" class="link border-0">
            <span class="rounded-5 mx-5 mb-4 mt-2 px-4 d-flex justify-content-center align-items-center bg-green" style="min-width: 120px; padding: 6px 0 6px 0; background-color: #d9f2ec;">
                Sell an Item
            </span>
        </a>

        <h4 class="fw-bold mx-5" style="font-size: 25px; letter-spacing: 1px;"><i class="bi bi-tags me-2"></i> KATEGÓRIE</h4>

        @foreach ($categories as $category)
            <a href="{{$category->id}}" class="sidebar-link link">
                <div class="py-2 px-5">
                    <span class="mb-0 ms-4" style="font-size: 20px;">{!!$category->icon!!}</span>
                    <span class="mb-0 ms-4" style="font-size: 18px;">{{$category->category_name}}</span>
                </div>
            </a>
        @endforeach
    </div>      
</div>