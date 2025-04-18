<style>
    .displayStars i {
        font-size: 1rem; 
        color: #f1c40f;    
        margin-right: 4px;  
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
        <div class="container">
            <div class="row mt-4">
                @foreach ($users as $user)
                    <div class="col-6 col-sm-3 col-md-2 mb-3">
                        <a href="/users/{{$user->username}}" class="link user-card d-block bg-white rounded border text-center listing-hover">
                            <p class="mt-2 mb-1 fw-semibold fs-6">{{$user->name}}</p>
                            <div class="mb-2">
                                <div id="displayStars" class="displayStars d-flex flex-nowrap justify-content-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= round($user->averageRating(), 1) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                    @endfor
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
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