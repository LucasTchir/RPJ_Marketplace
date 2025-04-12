<x-layout>

    <style>
        input::placeholder {
            font-size: 14px;      
            color: black;
            font-weight: 600;
            font-family: "Inter", sans-serif;
        }
    </style>

    <x-sidebar :categories="$categories"/>
    <div class="navbar-wrapper">
        <x-navbar :categories="$categories"/>
    </div>

    <div class="content px-4" id="content" style="padding-top: 110px;">
        <div class="" style="max-width: 1600px; margin: 0 auto;">
            <p class="fw-bold fs-3 text-uppercase mt-5" style="">{{$category->category_name}} ({{$listingsInCategoryCount}})</p>

            <div class="d-flex justify-content-center">
                <div id="mapy" style="width: 100%; height: 350px;" class="rounded-4" style="z-index: 1 !important;"></div>
            </div>

            <div class="d-flex mt-3">
                <x-filter :category="$category"/>
            </div>
        </div>      

        <div class="mt-3">
            <div class="" style="max-width: 1710px; margin: 0 auto;">
                <div class="row d-flex justify-content-start px-1 px-sm-5">
                    @forelse ($listings as $listing)
                        <x-listing :listing="$listing"/>
                    @empty
                        <p>V tejto kategórii nie sú dostupné žiadne inzeráty.</p>
                    @endforelse
                </div>
                
                <div class="d-flex justify-content-center">
                    {{ $listings->links() }}
                </div>
            </div>   
        </div> 

        {{-- <div class="mt-3">
            <div class="row d-flex justify-content-around">
                @forelse ($listings as $listing)
                    <x-listing :listing="$listing"/>
                @empty
                    <p>No listings available in this category.</p>
                @endforelse
            </div>

            {{ $listings->links() }}
        </div> --}}
    </div>

    <script>
        var map = L.map('mapy').setView([48.7004384, 19.4589212], 7);
    
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    
        var locations = @json($locations);
    
        locations.forEach(function(location) {
            let popupContent = `
                <div class="card card-div shadow-sm px-2 rounded-4 border-0" style="max-width: 600px;">
                    <a href="/listings/${location.id}" class="card-a link d-flex flex-column align-items-center">
                        <div class="card-body px-0">
                            <img src="/storage/${location.main_image}" alt="Listing Image" 
                                class="card-img img-fit rounded-4 responsive-image" style="height: 100px; width: 100px;">
                            
                            <div class="px-2">
                                <div class="mt-2">
                                    <p class="card-text" style="font-size: 14px; color: black;">${location.item_name}</p>
                                </div>
                                <div class="">
                                    <div class="card-text fw-bold" style="font-size: 16px; color: black;">
                                        ${location.price} €
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>`

            const radius = 4000;
            L.circle([location.lat, location.lng], {
                color: 'black', 
                fillColor: '#red', 
                fillOpacity: 0.3, 
                radius: radius
            }).addTo(map).bindPopup(popupContent);
        });

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
    </script>
</x-layout>