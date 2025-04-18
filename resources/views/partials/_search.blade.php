<div class="d-flex justify-content-center align-items-center search" style="height: 38vh !important; background-image: url('{{ asset('images/sliderbg1.jpg') }}'); background-size: cover; background-position: center; box-shadow: inset 0px 0px 10px 2px rgba(0,0,0,0.75);">
    <div id="listingCarousel" class="carousel slide w-100 mx-5" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner text-center">
            @foreach ($listings as $index => $listing)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-center align-items-center h-100" style="margin-left: 200px;">
                        <div class="slider-listing rounded-4 d-flex flex-row p-3" style="max-height: 300px; width: 500px; background-color: rgb(255, 255, 255); box-shadow: 0 4px 15px rgba(0,0,0,0.3); box-shadow: rgba(0, 0, 0, 0.35) 0px -50px 36px -28px inset;"> 
                            <x-listing-mini :listing="$listing" />
                            <div class="slider-listing-info text-dark d-flex flex-column align-items-center ms-4 mt-3">
                                <a href="/users/{{$listing->user->username}}" class="fw-semibold link d-flex align-items-center ms-5 mt-3 text-dark text-decoration-none">
                                    <span class="rounded-circle overflow-hidden me-3" style="width: 42px; height: 42px;">
                                        <img class="w-100 h-100 object-fit-cover" src="{{$listing->user->photo ? asset("storage/" . $listing->user->photo) : asset("/images/blank-profile-picture.png")}}" alt="...">
                                    </span>
                                    <span class="fs-5 text-dark">{{$listing->user->name}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
