<x-layout>
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        input::placeholder {
            font-size: 14px;      
            color: black;
            font-weight: 600;
            font-family: "Montserrat", serif;
        }
    </style>

    <x-sidebar :categories="$categories"/>
    <div class="navbar-wrapper">
        <x-navbar :categories="$categories"/>
    </div>

    <div class="content" id="content" style="padding-top: 130px;">
        @include("partials._search")

        <div class="px-4">
            @if (!empty($categoriesWithListings))
                <h4 class="fw-bold text-center mt-5 mb-5 fs-3">To najlepšie pre vás</h4>
                <div class="d-flex justify-content-around flex-wrap odporucane-wrapper" style="width: 80%; margin: 0 auto;">
                    @foreach ($categoriesWithListings as $data)
                        <div class="border shadow-sm rounded-4 odporucane-box mb-3" style="width: 31%; background-color: #fff;">
                            <h4 class="text-center fw-semibold mt-4 mb-4">{{ $data['category'] }}</h4>
                            <div class="d-flex justify-content-around px-4 mb-4">
                                @foreach ($data['listings'] as $listing)
                                    <x-listing-mini :listing="$listing" />
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>  
            @endif

            {{-- <div class="mt-4">
                @if($recommendedListings->isEmpty())
                    <p></p>
                @else
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold" style="font-size: 24px;">Navrhnuté len pre vás</span>
                    </div>
    
                    <div class="row d-flex justify-content-start px-4">
                        @foreach ($recommendedListings as $listing)
                            <x-listing :listing="$listing"/>
                        @endforeach
                    </div>
                @endif
            </div> --}}

            <div class="mt-5">
                @if($nearListings->isEmpty())
                    <p></p>
                @else
                    <div class="" style="max-width: 1710px; margin: 0 auto;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center">
                                <span class="fw-bold fs-4 pb-2">
                                    Vo vašom okolí
                                </span>
                            </div>

                            <a href="/" class="fw-semibold link" style="font-size: 14px;">Zobraziť všetko</a>
                        </div>
                        
                        <div class="row d-flex justify-content-center justify-content-sm-start px-1 px-sm-5">
                            @foreach ($nearListings as $listing)
                                <x-listing :listing="$listing"/>
                            @endforeach
                        </div>         
                    </div>         
                @endif
            </div>

            <div class="mt-4">
                @if($listings->isEmpty())
                    <p></p>
                @else
                    <div class="" style="max-width: 1710px; margin: 0 auto;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center">
                                <span class="fw-bold fs-4 pb-2">
                                    Nedávno pridané
                                </span>
                            </div>
                        </div>
                        
                        <div class="row d-flex justify-content-center justify-content-sm-start px-1 px-sm-5">
                            @foreach ($listings as $listing)
                                <x-listing :listing="$listing"/>
                            @endforeach
                        </div>         
                    </div>         
                @endif
            </div>

            <div class="mt-4">
                @foreach ($categories as $category)
                    @if(!$categoryListings[$category->id]->isEmpty())
                        <div class="" style="max-width: 1710px; margin: 0 auto;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold fs-4">{{ $category->category_name }}</span>
                                <a href="/category/{{ $category->id }}" class="fw-semibold link fs-6">Zobraziť všetko</a>
                            </div>

                            <div class="row d-flex justify-content-center justify-content-sm-start px-1 px-sm-5">
                                @foreach ($categoryListings[$category->id] as $listing)
                                    <x-listing :listing="$listing" />
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>            
        </div>
    </div>

</x-layout>