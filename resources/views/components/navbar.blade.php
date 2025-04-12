<div class="" style="">
    <div class="row border-bottom m-0" style="background-color: #fff; position: fixed; top: 70px; z-index: 7; width: 100%; max-width: inherit; height: 60px;">
        <div class="d-flex justify-content-around align-items-center">
            <a href="/" class="link d-flex align-items-center">
                <span class="fs-5"><i class="bi bi-shop"></i></span>
        
                <span class="ps-3">
                    <p class="mb-0 fw-semibold" style="font-size: 14px;">Prehliadať</p>
                </span>
            </a>

            <a href="/home/sellers" class="link d-flex align-items-center">
                <span class="fs-5"><i class="bi bi-people"></i></span>
        
                <span class="ps-3">
                    <p class="mb-0 fw-semibold" style="font-size: 14px;">Predajcovia</p>
                </span>
            </a>
    
            <a href="/home/notifications" class="link d-flex align-items-center">
                <span class="fs-5"><i class="bi bi-bell"></i></span>
    
                <span class="ps-3">
                    <p class="mb-0 fw-semibold" style="font-size: 14px;">Upozornenia</p>
                </span>
            </a>
    
            <span class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="fs-5"><i class="bi bi-tags"></i></span>
                    <span class="ps-3">
                        <p class="mb-0 fw-semibold" style="font-size: 14px;">Kategórie</p>
                    </span>
                </a>
                <div class="dropdown-menu rounded-1 mt-2 shadow" 
                     style="width: 300px; max-height: 500px; overflow-y: auto; background-color: #f8f9fa; border: 1px solid #ddd;" 
                     aria-labelledby="navbarDropdown">
                    @php
                        $categoriesChunks = $categories->chunk(ceil($categories->count() / 3));
                    @endphp
            
                    @foreach ($categoriesChunks as $chunk)
                        <ul class="list-unstyled px-3 py-2">
                            @foreach ($chunk as $category)
                                <li class="mb-2">
                                    <a class="dropdown-item d-flex align-items-center text-decoration-none" 
                                       href="/category/{{$category->id}}" 
                                       style="color: #333; padding: 8px 10px; border-radius: 4px; transition: all 0.3s;">
                                        <span class="pe-2">{!! $category->icon !!}</span>
                                        <span>{{$category->category_name}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </span>

            @if (auth()->check() && auth()->user()->isAdmin())
                <a href="/dashboard" class="link d-flex align-items-center">
                    <span class="fs-5"><i class="bi bi-layout-text-window-reverse"></i></span>
        
                    <span class="ps-3">
                        <p class="mb-0 fw-semibold" style="font-size: 14px;">Ovladací panel</p>
                    </span>
                </a>
            @endif
    
            <a href="/create" class="link border-0">
                <span class="rounded-5 d-flex justify-content-center align-items-center bg-green" style="min-width: 140px; padding: 4px 0 4px 0; background-color: #d9f2ec;">
                    <p class="mb-0 fw-semibold" style="font-size: 14px;">Vytvoriť inzerát</p>
                </span>
            </a>
        </div>
    </div>
</div>