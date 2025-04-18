@props(['listing'])

<div class="card border-0 shadow-sm rounded-4 mx-3 my-4 listing-hover" style="max-width: 240px; min-width: 240px;">
    <a href="/listings/{{$listing->id}}" class="text-decoration-none text-dark">
        <img src="{{ asset('storage/' . $listing->main_image) }}" alt="" 
             class="card-img-top rounded-4" style="height: 200px; object-fit: cover;">
        <div class="card-body text-start">
            <p class="card-text fw-semibold text-truncate" style="font-size: 1rem;">{{$listing->item_name}}</p>
            <div class="card-text fw-bold" style="font-size: 1.25rem;">
                @if (fmod($listing->price, 1) == 0)
                    {{ number_format($listing->price, 0, '.', ' ') }} €
                @else
                    {{ number_format($listing->price, 2, '.', ' ') }} €
                @endif
            </div>
        </div>
    </a>
</div>
