<x-layout>
    <style>
        @media (max-width: 991px) {
            .kontajner {
                min-width: 90%;
            }
            .side {
                border-top-left-radius: 1rem !important;
                border-bottom-right-radius: 0 !important;
            }
            #toggleSidebar {
                display: none;
            }
        }
    </style>

    <div class="kontajner container w-50 rounded-4" style="margin-top: 110px; min-height: 70vh;">
        <div class="row" style="min-height: 70vh;">
            <div class="side col-lg-5 col-12 d-flex justify-content-center rounded-4 order-first order-lg-last" style="background-color: #3bb397;">
                <div class="d-flex flex-column align-items-center justify-content-center text-white">
                    <h3 class="fw-bold my-4 fs-2 text-center">Vitaj!</h3>
                    <p class="text-center px-2">Pripojte sa k našej komunite a nakupujte a predávajte ešte dnes! {{-- Discover amazing products, connect with trusted sellers, and enjoy a seamless shopping experience. --}}</p>

                    <a href="/register" class="link border border-white rounded-5 px-5 py-2 mt-4 mb-3 d-flex justify-content-center align-items-center text-white" 
                        style="min-width: 170px; min-height: 50px; padding: 6px 0 6px 0; background-color: #3bb397;">
                        Zaregistrovať
                    </a>
                </div>
            </div>

            <div class="col-lg-7 col-12 d-flex">
                <div class="d-flex flex-column align-items-center justify-content-center w-100">

                    <h3 class="fw-bold my-5 fs-2 text-center">Prihlásenie</h3>

                    <form method="POST" action="/users/authenticate" class="text-center">
                        @csrf
                            <input
                                type="text"
                                class="mb-3 border-0 px-3 py-2 w-75"
                                style="background-color: #f1f1f1;"
                                name="username"
                                placeholder="Prihlasovacie meno"
                                value="{{old("username")}}"/>

                            @error("username")
                                <p class="text-danger">Nesprávne prihlasovacie meno.</p>
                            @enderror
                    
                            <input
                                type="password"
                                class="mb-3 border-0 px-3 py-2 w-75"
                                style="background-color: #f1f1f1;"
                                name="password"
                                placeholder="Heslo"
                                value="{{old("password")}}"/>
                    
                            @error("password")
                                <p class="text-danger">Nesprávne heslo!</p>
                            @enderror

                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="border-0 rounded-5 px-5 py-2 mt-4 mb-5 d-flex justify-content-center align-items-center text-white" 
                                    style="min-width: 40%; min-height: 50px; padding: 6px 0 6px 0; background-color: #3bb397;">
                                    Prihlásiť sa
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>

{{-- Neviem ci nechat sidebar alebo nn --}}