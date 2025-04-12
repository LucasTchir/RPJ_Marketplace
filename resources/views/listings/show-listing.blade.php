<?php
    $formattedPhone = preg_replace('/(\+421)(\d{3})(\d{3})(\d{3})/', '$1 $2 $3 $4', $user->phone);
?>

<x-layout>
    <x-sidebar :categories="$categories"/>
    <div class="navbar-wrapper">
        <x-navbar :categories="$categories"/>
    </div>

    <div class="content px-4" id="content" style="padding-top: 130px;">
        <div class="row pt-1">
            <div class="col-12 col-lg-7 px-0 d-flex flex-column align-items-center justify-content-center">
                <!-- Main obrazok -->
                <div class="d-flex justify-content-center align-items-center mb-3" style="width: 100%;">
                    <img src="{{ asset('storage/' . $listing->main_image) }}" alt="Hlavný obrázok" 
                        id="mainImageLarge" class="rounded-4" 
                        style="max-width: 100%; max-height: 50vh; object-fit: contain;">
                </div>
            
                <!-- Mini obrazky -->
                <div class="d-flex flex-wrap justify-content-center px-2">
                    <!-- mini main obrazok -->
                    <div class="p-2">
                        <div class="rounded-4 mini-img" 
                            style="background-color: #f2f2f2; width: 110px; height: 110px; cursor: pointer;">
                            <img src="{{ asset('storage/' . $listing->main_image) }}" alt="Hlavný obrázok" 
                                class="rounded-4" 
                                style="width: 100%; height: 100%; object-fit: cover;" 
                                onclick="changeMainImage(this)">
                        </div>
                    </div>
            
                    <!-- mini obrazky -->
                    @if(!empty($listing->image))
                        @foreach(json_decode($listing->image) as $image)
                            <div class="p-2">
                                <div class="rounded-4 mini-img" 
                                    style="background-color: #f2f2f2; width: 110px; height: 110px; cursor: pointer;">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Obrázok" 
                                        class="rounded-4" 
                                        style="width: 100%; height: 100%; object-fit: cover;" 
                                        onclick="changeMainImage(this)">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center mt-2">Žiadne obrázky.</p>
                    @endif
                </div>
            </div>
            
            
            <div class="col-12 col-lg-5 pt-2 listing-info-div" {{-- style="max-height: 80vh;" --}}>
                <div class="d-flex justify-content-between align-items-end">
                    <p class="fs-6 mb-0" style="color: #8c8c8c;">{{$listing->category->category_name}}</p>
                            <div class="dropdown">
                                <button class="btn border-0 fs-5 p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 100%; padding: 5px;">
                                    @auth
                                        @if (auth()->user()->id == $listing->user_id)
                                            <li>
                                                <a class="dropdown-item rounded-3 link text-dark" href="/listing/edit/{{$listing->id}}" style="font-size: 14px; padding: 5px 10px;">Upraviť</a>                                       
                                            </li>

                                            <li>
                                                <a class="dropdown-item rounded-3 link text-dark" href="/profile/manage" style="font-size: 14px; padding: 5px 10px;">Spravovať</a> 
                                            </li>
                                        @endif
                                    @endauth  

                                    <li>
                                        <a class="dropdown-item rounded-3 link text-dark" href="/listing/report/{{$listing->id}}" style="font-size: 14px; padding: 5px 10px;">Nahlásiť</a> 
                                    </li>
                                </ul>
                            </div>                                    
                </div>

                <p class="fs-3 fw-bold mb-0">{{$listing->item_name}}</p>
                
                <p class="fs-4 fw-bold mb-0 rounded-4" style="">{{ number_format($listing->price, 2, '.', ' ') }} €</p>

                <div class="d-flex align-items-center mt-2 flex-wrap">
                    <a href="/users/{{$user->username}}" class="btn d-flex align-items-center me-2 mt-1" style="background-color: #e6e6e6; height: 38px;">
                        <span class="rounded-circle d-inline-block me-2" style="width: 28px; height: 28px; overflow: hidden;">
                            <img class="w-100 h-100 object-fit-cover" src="{{$user->photo ? asset("storage/" . $user->photo) : asset("/images/blank-profile-picture.png")}}" alt="...">
                        </span>

                        <span>{{$user->name}}</span>
                    </a>

                    @if (auth()->check() && auth()->user()->name !== $user->name)
                        @if (!empty($isFollowing) && $isFollowing)
                            <form action="/unfollow/{{$user->name}}" method="POST" class="me-2 me-sm-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn d-flex align-items-center me-2 mt-1" style="background-color: #e6e6e6;">
                                    <i class="bi bi-person-dash-fill me-2"></i>
                                    <span>Prestať sledovať</span>
                                </button>
                            </form>
                        @else
                            <form action="/follow/{{$user->name}}" method="POST" class="me-2 me-sm-0">
                                @csrf
                                <button type="submit" class="btn d-flex align-items-center me-2 mt-1" style="background-color: #e6e6e6;">
                                    <i class="bi bi-person-plus-fill me-2"></i>
                                    <span>Sledovať</span>
                                </button>
                            </form>
                        @endif
                    @endif

                    @if (!empty($user->email))
                        <div class="btn d-flex align-items-center me-2 mt-1" style="background-color: #e6e6e6; height: 38px;">
                            <i class="bi bi-envelope-fill fs-5 me-2"></i>
                            <span>{{$user->email}}</span>
                        </div>
                    @else 
                        <span></span>
                    @endif

                    @if (!empty($user->phone))
                        <div class="btn d-flex align-items-center me-2 mt-1" style="background-color: #e6e6e6; height: 38px;">
                            <i class="bi bi-telephone-fill me-2"></i>
                            <span>{{$formattedPhone}}</span>
                        </div>
                    @else 
                        <span></span>
                    @endif

                    {{-- @if (auth()->user()->id != $user->id)
                        <a href="/interest/{{$listing->id}}" class="btn d-flex align-items-center me-2" style="background-color: #e6e6e6; height: 38px;">
                            <i class="bi bi-chat-left-text-fill me-2"></i>
                            <span>Mam záujem</span>
                        </a>
                    @else
                        <div></div>
                    @endif --}}
                </div>

                <p class="fw-bold fs-6 mt-2 mb-0">Popis:</p>
                <div id="description" class="mb-0 description-box" style="width: 80%; word-wrap: break-word; overflow-wrap: break-word; white-space: pre-line; text-overflow: ellipsis;">
                    {{$listing->description}}
                </div>

                {{-- <p class="fw-bold fs-6 mt-3 mb-0">Condition:</p>
                <p class="mb-0">{{$listing->condition}}</p> --}}

                {{-- Mnozstvo nechcem mat --}}
                {{-- @if (!is_null($listing->quantity))
                    <p class="fw-bold fs-6 mt-2 mb-0">Množstvo:</p>
                    <p class="mb-0">{{ $listing->quantity }}</p>
                @endif --}}

                <div class="d-flex justify-content-start mt-4">
                    <div id="map" style="width: 80%; height: 200px;" class="rounded-4" style="z-index: 1 !important;"></div>
                </div>
                
                <script>
                    const map = L.map('map').setView([{{ $listing->lat }}, {{ $listing->lng }}], 11);
                
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    var searchControl = new L.Control.Search({
                        url: 'https://nominatim.openstreetmap.org/search?format=json&q={s}',
                        jsonpParam: 'json_callback',
                        propertyName: 'display_name',
                        propertyLoc: ['lat', 'lon'],
                        autoCollapse: true,
                        autoType: false,
                        minLength: 2
                    });
                    map.addControl(searchControl);
                
                    const radius = 3000; 
                    L.circle([{{ $listing->lat }}, {{ $listing->lng }}], {
                        color: 'black', 
                        fillColor: '#red', 
                        fillOpacity: 0.3, 
                        radius: radius
                    }).addTo(map).bindPopup("Približná oblasť: {{ $listing->name }}");
                
                </script>

                <div class="d-flex justify-content-between align-items-end" style="width: 80%;">
                    <div class="d-flex justify-content-start mt-3">
                        {{-- @auth
                            @if (auth()->user()->id != $user->id)
                                <a href="/interest/{{$listing->id}}" class="btn d-flex align-items-center me-2" style="background-color: #e6e6e6; height: 38px;">
                                    <i class="bi bi-chat-left-text-fill me-2"></i>
                                    <span>Mam záujem</span>
                                </a>
                            @else
                                <div></div>
                            @endif
                        @endauth --}}
                    </div>
    
                    <div class="mt-2">
                        <span class="" style="font-size: 13px; color:#8c8c8c;">Uverejnené: {{$listing->created_at->diffForHumans()}}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="mb-1 mt-4 d-flex justify-content-between">
            <span class="fw-bold" style="font-size: 21px;">Preskúmajte viac z tejto kategórie</span>
            <a href="/category/{{$listing->category_id}}" class="fw-semibold link" style="font-size: 14px;">Zobraziť všetko</a>
        </div>

        <div class="row d-flex justify-content-start px-3">
            @unless(count($listings) == 0)
                @foreach ($listings as $listing)
                    <x-listing :listing="$listing"/>
                @endforeach
            @else
                <p>Žiadne najdené položky.</p>
    
            @endunless
        </div> --}}

        <div class="mt-5" style="max-width: 1710px; margin: 0 auto;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center">
                    <span class="fw-bold fs-4 pb-2">
                        Preskúmajte viac z tejto kategórie
                    </span>
                </div>

                <a href="/category/{{$listing->category_id}}" class="fw-semibold link" style="font-size: 14px;">Zobraziť všetko</a>
            </div>
            
            <div class="row d-flex justify-content-center justify-content-sm-start px-4">
                @unless(count($listings) == 0)
                    @foreach ($listings as $listing)
                        <x-listing :listing="$listing"/>
                    @endforeach
                @else
                    <p>Žiadne najdené položky.</p>
                @endunless
            </div>         
        </div>         
    </div>

    <script>
        /* Sidebar */
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            sidebar.classList.toggle('active');
            content.classList.toggle('active-content');
        });

        /* Zmena obrazku */
        function changeMainImage(thumbnail) {
            const newImageSrc = thumbnail.src;

            document.getElementById('mainImageLarge').src = newImageSrc;
        }

        /* Popis */
        const descriptionDiv1 = document.getElementById('description');
        // Zisti ci sirka je < ako lg
        descriptionDiv1.addEventListener('wheel', (event) => {
        const isSmallScreen = window.innerWidth < 1024;

        if (!isSmallScreen) {
            const atTop = descriptionDiv1.scrollTop === 0;
            const atBottom = descriptionDiv1.scrollTop + descriptionDiv1.clientHeight >= descriptionDiv1.scrollHeight;

            // Zablokovať scroll stranky ak pridem na koniec popisu
            if ((atTop && event.deltaY < 0) || (atBottom && event.deltaY > 0)) {
                event.preventDefault();
            }
        }
    });
    </script>
</x-layout> 