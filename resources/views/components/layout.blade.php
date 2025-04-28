<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/images/M-logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/96f429efb1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/gh/stefanocudini/leaflet-search@latest/dist/leaflet-search.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/stefanocudini/leaflet-search@latest/dist/leaflet-search.min.css">
    <style>
        .inter {
            font-family: "Inter", sans-serif;
        }

        .montserrat {
            font-family: "Montserrat", serif;
        }

        html, body {
            min-height: 100%;
            height: 100%;
            margin: 0;
        }

        .bg-green {
            border: 1px solid #3bb397;
        }

        .sidebar {
            transform: translateX(-200%);
            min-height: 100%;
            max-height: 100vh;
            overflow-y: auto;
            position: fixed;
            min-width: 350px;
            background-color: #fff;
            padding: 84px 0 0 0;
            /* box-shadow: 2px 0 5px rgba(0,0,0,0.1); */
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar-user {
            min-height: 100%;
            position: fixed;
            width: 330px;
            right: 0;
            padding: 0;
            z-index: 9;
        }

        .scrollable-div {
            overflow-y: scroll;
            scrollbar-width: none;
        }

        .content {
            z-index: -2;
        }

        #toggleSidebar {
            display: none;
        }

        .sidebar-link:hover {
            border-left: 4px solid black;
            background-color: #f1f1f1;
        }

        .link {
            text-decoration: none;
            color: black;
        }

        .img-fit {
            width: 100%;        
            height: 200px;       
            object-fit: cover;
        }

        .desc-scrollbar::-webkit-scrollbar {   /* Chrome */
            display: none; 
        }

        .desc-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        /* DROPDOWN */
        .nav-item .dropdown-menu {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 10px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-height: 300px; /* Limits height */
            overflow-y: auto;  /* Enables vertical scrolling */
            scrollbar-width: thin; /* For Firefox */
            scrollbar-color: #ccc #f9f9f9; /* For Firefox */
        }

        .nav-item .dropdown-menu::-webkit-scrollbar {
            width: 8px; /* Scrollbar width */
        }

        .nav-item .dropdown-menu::-webkit-scrollbar-thumb {
            background: #ccc; /* Scrollbar thumb color */
            border-radius: 4px;
        }

        .nav-item .dropdown-menu::-webkit-scrollbar-thumb:hover {
            background: #999; /* Hover effect on scrollbar thumb */
        }

        .nav-item .dropdown-menu::-webkit-scrollbar-track {
            background: #f9f9f9; /* Scrollbar track color */
        }

        /* Leaflet kontajner */
        .leaflet-container {
            z-index: 1 !important;
        }

        /* Popis */
        .description-box {
            white-space: pre-line;
            font-size: 14px;
            overflow-y: hidden; 
            max-height: none;    
        }

        /* Listing hover */
        .listing-hover {
            transition: transform 0.3s ease;
        }

        .listing-hover:hover {
            transform: translateY(-5px);
        }

        /* Link hover */
        .link-hover {
            transition: transform 0.3s ease;
        }

        .link-hover:hover {
            transform: scale(1.05);
        }

        @media (max-width: 1088px) {
            .odporucane-box {
                width: 45% !important;  
            }
        }

        @media (min-width: 992px) {
            .description-box {
                overflow-y: scroll;  
                max-height: 35vh;    
            }
        }

        @media (max-width: 992px) {
            div.slider-margin {
                margin-left: 0px !important;
            }

            div.slider-listing {
                width: 100% !important;
                max-width: 500px;
            }
        }


        @media (max-width: 839px) { 
            .card-div {
                max-width: 210px !important;
            }
            .card-img {
                max-width: 180px !important;
                max-height: 180px !important;
            }
            .card-a {
                max-width: 180px !important;
            }
        }
        
        @media (max-width: 790px) { 
            .auth-div {
                display: none !important;
            }
            .sidebar {
                transform: translateX(-110%);
                min-width: 100%; 
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .content {
                padding-left: 0;
                padding-top: 70px !important; 
            }
            #toggleSidebar {
                display: flex;
            }
            .content.active-content {
                margin-left: 0;  
            }
            .navbar-wrapper {
                display: none;
            }
        }

        @media (max-width: 747px) {
            .odporucane-box {
                width: 70% !important;  
            }

            .slider-listing-info {
                display: none;
            }

            .slider-listing {
                justify-content: center;
            }
        }

        @media (max-width: 585px) {
            .navbar-search {
                display: none;
            }
            .navbar-search-sidebar {
                display: inline !important;
            }

            .card-div {
                max-width: 160px !important;
            }
            .card-img {
                max-width: 130px !important;
                max-height: 130px !important;
            }
            .card-a {
                max-width: 130px !important;
            }
        }

        .category-card.selected {
            border-color: black !important;
        }

        .category-card.selected .icon,
        .category-card.selected .text {
            color: black !important;
        }

    </style>

    <title>Marketplace</title>
</head>
<body style="height: 100% !important;">
    <div class="container-fluid px-0 montserrat" style="overflow-x: hidden; position: relative; height: 100% !important;">
        <div class="px-4 m-0 d-flex align-items-center justify-content-between" style="background-color: #fff; position: fixed; width: 100%; z-index: 1001; max-width: inherit; height: 70px; padding-top: 10px;">
            <div class="">
                <a href="/" class="link"><h2 class="mb-0 fw-bold" style="letter-spacing: 1px; font-size: 34px;">MARKETPLACE</h2></a>
            </div>

            @if (!request()->is("setup/*", "create", "profile/edit/*", "login", "register"))
                <div class="navbar-search" style="width: 60%;">
                    <form action="/home/search" class="d-flex px-4 pb-0 mb-0">
                        <input type="text" name="search" class="border form-control border-black rounded-start-5 box-shadow" 
                        style="font-size: 14px; height: 40px; border-radius: 5px 0 0 5px;" placeholder="Čo môžeme pre vás nájsť?" value="{{request('search')}}">

                        <button type="submit" class="btn border border-start-0 border-black rounded-end-5 px-3" 
                        style="border-radius: 0 5px 5px 0; height: 40px;"><i class="bi bi-search text-dark me-1"></i></button>
                    </form>
                </div>
            @endif

            <div class="">
                @auth
                    <div class="d-flex justify-content-end align-items-center auth-div">
                        <p class="mb-0 mx-3" style="font-size: 18px;">
                            Vitaj, <span class="mb-0 fw-semibold">{{auth()->user()->name}}</span>!
                        </p>
                    
                        <div class="d-flex align-items-center" style="cursor: pointer;">
                            <a href="/users/{{auth()->user()->username}}" class="d-flex justify-content-center align-items-center">
                                <span class="rounded-circle d-inline-block" style="width: 42px; height: 42px; overflow: hidden;">
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
                    </div>
                @else
                    <div class="d-flex justify-content-around align-items-center auth-div" style="width: 300px;">
                        <a href="/register" class="link link-hover">
                            <span class="border rounded-5 border-black d-flex justify-content-center align-items-center" style="min-width: 140px; padding: 6px 0 6px 0;">
                                Registrácia
                            </span>
                        </a>
                            
                        <a href="/login" class="link link-hover">
                            <span class="border rounded-5 border-black bg-black px-4 d-flex justify-content-center align-items-center" style="min-width: 140px; padding: 6px 0 6px 0; color: white;">
                                Prihlásenie
                            </span>
                        </a>
                    </div>
                @endauth

                <a href="#" id="toggleSidebar" class="fs-1" style="color: black;">
                    <i class="bi bi-list"></i>
                </a>
            </div>
        </div>

        <div class="container-fluid p-0" style="min-height: 100% !important;">
            {{$slot}}
        </div>

        <footer class="d-flex justify-content-around border-top p-4" style="background-color: #fff; text-align: center; bottom: 0; color: #707070">
            <div class="text-start">&copy; 2025 Marketplace, Všetky práva vyhradené</div>
            <div class="">Vytvoril Lucas Tchir</div>
        </footer>
    </div>

    <x-flash-message />
    
    <script>
        /* Sideabar */
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            sidebar.classList.toggle('active');
            content.classList.toggle('active-content');
        });

        /* Mapa */
        var map = L.map('map').setView([48.7676715, 19.6893157], 7);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
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

        let marker;

        /* Klik event */
        map.on('click', function(e) {
            const { lat, lng } = e.latlng;

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);

            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>