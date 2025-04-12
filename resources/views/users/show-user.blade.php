<?php
    $formattedPhone = preg_replace('/(\+421)(\d{3})(\d{3})(\d{3})/', '$1 $2 $3 $4', $user->phone);
    $averageRating = round($user->averageRating(), 1);
?>

<style>
    .displayStars i {
        font-size: 1.5rem; 
        color: #f1c40f;    
        margin-right: 8px;  
    }

    #displayStars i.bi-star {
        color: #ccc; 
    }
</style>

<x-layout>
    <x-sidebar :categories="$categories"/>
    <div class="navbar-wrapper">
        <x-navbar :categories="$categories"/>
    </div>

    <div class="content" id="content" style="padding-top: 130px;">
            <div class="row py-4 px-3 border-bottom" style="max-width: 1700px; margin: 0 auto;" {{-- style="background-image: url('{{ asset('images/user-background2.jpg') }}');" --}}>
                <div class="col-12 col-lg-2 d-flex flex-column justify-content-start align-items-center">
                    <img class="img-fluid rounded-circle img-thumbnail object-fit-cover mb-2" style="max-width: 150px; min-width: 150px; max-height: 150px; min-height: 150px; width: 100%;" src="{{$user->photo ? asset("storage/" . $user->photo) : asset("/images/blank-profile-picture.png")}}" alt="">

                    <span class="fw-semibold mt-2">Hodnotenie:</span>

                    <div class="mt-1">
                        <div id="displayStars" class="displayStars d-flex flex-nowrap">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= round($averageRating) ? 'bi-star-fill' : 'bi-star' }}"></i>
                            @endfor
                        </div>
                    </div>

                    <span class="fw-semibold mt-1">({{$ratingsCount}})</span>

                    @auth
                        @if (auth()->user()->id != $user->id)
                            <button class="btn fw-semibold py-1 mt-3 mb-2" style="background-color: #e6e6e6;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Ohodnotiť
                            </button>
                            <div class="collapse" id="collapseExample">
                                <div class="card px-3 mb-1">
                                    <div class="d-flex flex-column">
                                        <span id="stars" class="displayStars mt-2 d-flex flex-nowrap" data-rated="0">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star" data-value="{{ $i }}"></i>
                                            @endfor
                                        </span>
                                    </div>
                                    
                                    <form action="/rate" method="POST" id="ratingForm">
                                        @csrf
                                        <input type="hidden" name="rated_user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="rating" id="ratingValue">
                                    </form>
                                </div>
                            </div>
                        @else

                        @endif
                    @endauth
                </div>

                <div class="col-12 col-lg-10 mb-3 mb-lg-0">
                    <div class="d-flex flex-column align-items-center align-items-md-start justify-content-center">
                        <p class="fw-bold fs-4 mb-0 mt-2 mt-lg-0" style="color: #000;">{{$user->name}}</p>
                        <p class="fs-6 mb-2" style="color: #000;">{{"@"}}{{$user->username}}</p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap" style="color: #000;">
                        <div class="col-12 col-md-7 d-flex justify-content-center justify-content-md-start align-items-center flex-wrap">
                            <div class="btn d-flex align-items-center me-3 mb-1" style="background-color: #e6e6e6; height: 38px;">
                                {{-- <i class="bi bi-chat-left-text-fill me-2"></i> --}}
                                <span class="fw-semibold me-1">Inzeráty: </span>{{$user->listings_count}}</span>
                            </div>
    
                            <div class="btn d-flex align-items-center me-3  mb-1" style="background-color: #e6e6e6; height: 38px;">
                                {{-- <i class="bi bi-chat-left-text-fill me-2"></i> --}}
                                <span class="fw-semibold me-1">Sledovatelia: </span>{{$user->followers_count}}</span>
                            </div>
    
                            <div class="btn d-flex align-items-center me-3  mb-1" style="background-color: #e6e6e6; height: 38px;">
                                <span class="fw-semibold me-1">Telefón: </span>
                                @if (!empty($user->phone))
                                    <span>{{$formattedPhone}}</span>
                                @else 
                                    <span>Žiadne číslo</span>
                                @endif
                            </div>
    
                            <div class="btn d-flex align-items-center me-3 mb-1" style="background-color: #e6e6e6; height: 38px;">
                                <span class="fw-semibold me-1">Email: </span>
                                @if (!empty($user->email))
                                    <span>{{$user->email}}</span>
                                @else 
                                    <span>Žiadny email</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 col-md-5 d-flex justify-content-center justify-content-md-end align-items-center flex-wrap mt-2 mt-md-0">
                            @auth
                                @if (auth()->user()->id == $user->id)
                                    <a href="/profile/edit/{{auth()->user()->username}}" class="btn d-flex align-items-center me-3 mb-1" style="background-color: #e6e6e6; height: 38px;">
                                        <i class="bi bi-gear-fill me-2"></i>
                                        <span class="fw-semibold me-1">Upraviť Profil</span>
                                    </a>

                                    <a href="/profile/manage" class="btn d-flex align-items-center me-3 mb-1" style="background-color: #e6e6e6; height: 38px;">
                                        <i class="bi bi-pencil-square me-2"></i>
                                        <span class="fw-semibold me-1">Spravovať Inzeráty</span>
                                    </a>
                                @else
                                    @if (auth()->check() && auth()->user()->name !== $user->name)
                                        @if (!empty($isFollowing) && $isFollowing)
                                            <form action="/unfollow/{{$user->name}}" method="POST" class="me-2 me-sm-0 mb-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn d-flex align-items-center me-3 mb-1" style="background-color: #e6e6e6; height: 38px;">
                                                    <i class="bi bi-person-dash-fill me-2"></i>
                                                    <span class="fw-semibold me-1">Zrušiť sledovanie</span>
                                                </button>
                                            </form>
                                        @else
                                            <form action="/follow/{{$user->name}}" method="POST" class="me-2 me-sm-0 mb-0">
                                                @csrf
                                                <button type="submit" class="btn d-flex align-items-center me-3 mb-1" style="background-color: #e6e6e6; height: 38px;">
                                                    <i class="bi bi-person-plus-fill me-2"></i>
                                                    <span class="fw-semibold">Sledovať</span>
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>

                    <p class="fs-6 fw-semibold mb-0">Popis:</p>
                    <div class="desc-scrollbar {{-- border-top --}} px-4 py-1" style="/* background-color: #e6e6e6; */ word-wrap: break-word; overflow-wrap: break-word; white-space: pre-line; text-overflow: ellipsis; height: 150px; overflow-y: auto; display: block;">
                        <div class="fs-6 mb-2 mb-lg-0 text-center text-lg-start">{{$user->description}}</div>
                    </div>                                      
                </div>
            </div>

            <div class="mt-4" style="max-width: 1710px; margin: 0 auto;">
                <div class="d-flex justify-content-between align-items-center mb-2 mx-3">
                    <div class="d-flex align-items-center">
                        <span class="fw-bold fs-4 pb-2">
                            Nedávno pridané
                        </span>
                    </div>
                </div>
                
                <div class="row d-flex justify-content-center justify-content-sm-start px-1 px-sm-5">
                    @unless(count($listings) == 0)
                        @foreach ($listings as $listing)
                            <x-listing :listing="$listing"/>
                        @endforeach
                    @else
                        <p>Tento použivatel aktuálne nemá ziadne inzeráty.</p>
                    @endunless

                    <div class="d-flex justify-content-center mt-3">
                        {{ $listings->links() }}
                    </div>
                </div>         
            </div>       
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const stars = document.querySelectorAll("#stars i");
            const ratingForm = document.getElementById("ratingForm");
            const ratingValue = document.getElementById("ratingValue");

            stars.forEach(star => {
                star.addEventListener("mouseover", function () {
                    let value = this.getAttribute("data-value");
                    highlightStars(value, "#stars");
                });

                star.addEventListener("mouseout", function () {
                    let currentRating = document.getElementById("stars").getAttribute("data-rated");
                    highlightStars(currentRating, "#stars");
                });

                star.addEventListener("click", function () {
                    let value = this.getAttribute("data-value");
                    document.getElementById("stars").setAttribute("data-rated", value);
                    ratingValue.value = value;
                    ratingForm.submit();
                });
            });

            function highlightStars(value, selector) {
                document.querySelectorAll(selector + " i").forEach(star => {
                    let starValue = star.getAttribute("data-value");
                    star.classList.toggle("bi-star-fill", starValue <= value);
                    star.classList.toggle("bi-star", starValue > value);
                });
            }
        });
    </script>
</x-layout>
