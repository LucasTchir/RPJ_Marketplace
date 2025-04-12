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

        <p class="fw-bold fs-3 text-uppercase text-center mt-5" style="">kategoria</p>

        <div class="mt-2">
            <x-filter :category="$category"/>
        </div>

        <div class="mt-3">
            <div class="" style="max-width: 1700px; margin: 0 auto;">
                <div class="row d-flex justify-content-around px-4">
                    @forelse ($listings as $listing)
                        <x-listing :listing="$listing"/>
                    @empty
                        <p>No listings available in this category.</p>
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
</x-layout>