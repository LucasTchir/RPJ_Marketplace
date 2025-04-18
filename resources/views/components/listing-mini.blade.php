@props(['listing'])

<div class="card card-div shadow-sm px-2 rounded-4 border-0" style="max-width: 1600px;">
    <a href="/listings/{{$listing->id}}" class="card-a link d-flex flex-column align-items-center">
        <div class="card-body px-0 py-2">
            <img src="{{ asset('storage/' . $listing->main_image) }}" alt="Listing Image" 
                class="card-img img-fit rounded-4 responsive-image">
            
            <div class="px-2">
                <div class="mt-2 text-start">
                    <p class="card-text fw-semibold" style="font-size: 14px;">{{$listing->item_name}}</p>
                </div>
                <div class="text-start">
                    <div class="card-text fw-bold" style="font-size: 16px;">
                        @if (fmod($listing->price, 1) == 0)
                            {{ number_format($listing->price, 0, '.', ' ') }} €
                        @else
                            {{ number_format($listing->price, 2, '.', ' ') }} €
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<!-- Inline Styles -->
<style>
    .responsive-image {
        object-fit: cover;
        border-radius: 1rem;
        width: 170px;
        height: 170px;
    }

    @media (max-width: 1675px) {
        .responsive-image {
            width: 140px;
            height: 140px;
        }
    }

    @media (max-width: 1422px) {
        .responsive-image {
            width: 120px;
            height: 120px;
        }
    }

    @media (max-width: 1268px) {
        .responsive-image {
            width: 100px;
            height: 100px;
        }

        .odporucane-wrapper{
            display: flex;
            flex-wrap: wrap;
        }

        .odporucane-box {
            min-width: 273px;
        }
    }
</style>
