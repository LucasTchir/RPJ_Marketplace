<x-layout>
    <style>
        @media (max-width: 991px) {
            .kontajner {
                min-width: 90%;
            }
            .side {
                border-top-right-radius: 1rem !important;
                border-bottom-left-radius: 0 !important;
            }
            #toggleSidebar {
                display: none;
            }
        }
    </style>

    <div class="kontajner container w-50 rounded-4" style="margin-top: 110px; min-height: 70vh;">
        <div class="row" style="min-height: 70vh;">
            <div class="side col-lg-5 col-12 d-flex justify-content-center rounded-4" style="background-color: #3bb397;">{{-- #3aaea1 --}}
                <div class="d-flex flex-column align-items-center justify-content-center text-white">
                    <h3 class="fw-bold my-4 fs-2 text-center">Vitaj späť!</h3>
                    <p class="text-center px-2">Ponorte sa do svojho účtu a zistite, čo je nové na trhu..</p>
                
                    <a href="/login" class="link border border-white rounded-5 px-5 py-2 mt-4 mb-3 d-flex justify-content-center align-items-center text-white" 
                        style="min-width: 170px; min-height: 50px; padding: 6px 0 6px 0; background-color: #3bb397;">
                        Prihlásiť sa
                    </a>
                </div>
            </div>

            <div class="col-lg-7 col-12 d-flex">
                <div class="d-flex flex-column align-items-center justify-content-center w-100">

                    <h3 class="fw-bold my-5 fs-2 text-center">Vytvoriť účet</h3>

                    <form method="POST" action="/users" enctype="multipart/form-data" class="text-center w-75">
                        @csrf 
                            <div class="d-flex justify-content-between mb-3 px-3 py-1 w-100" style="background-color: #f1f1f1;">
                                <input
                                    type="text"
                                    class="border-0 w-100"
                                    style="background-color: #f1f1f1; outline: none;"
                                    name="name"
                                    placeholder="*Meno"
                                    value="{{old("name")}}"/>

                                <button type="button" class="btn border-0" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Musí obsahovať minimálne 4 znaky.">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                            </div>
                            @error("name")
                                <p class="text-danger">Zlý formát mena</p>
                            @enderror

                            <div class="d-flex justify-content-between mb-3 px-3 py-1 w-100" style="background-color: #f1f1f1;">
                                <input
                                    type="text"
                                    class="border-0 w-100"
                                    style="background-color: #f1f1f1; outline: none;"
                                    name="username"
                                    placeholder="*Prihlásovacie meno"
                                    value="{{old("username")}}"/>

                                <button type="button" class="btn border-0" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Nesmie obsahovať veľké písmená, minimálne 5 znakov.">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                            </div>
                            @error("username")
                                <p class="text-danger">Zlý formát prihlasovacieho mena</p>
                            @enderror

                            <div class="d-flex justify-content-between mb-3 px-3 py-1 w-100" style="background-color: #f1f1f1;">
                                <input
                                    type="email"
                                    class="border-0 w-100"
                                    style="background-color: #f1f1f1; outline: none;"
                                    name="email"
                                    placeholder="*Email"
                                    value="{{old("email")}}"/>

                                <button type="button" class="btn border-0" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Emailová adresa">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                            </div>
                            @error("email")
                                <p class="text-danger">Nesprávny email</p>
                            @enderror

                            <div class="d-flex justify-content-between mb-3 px-3 py-1 w-100" style="background-color: #f1f1f1;">
                                <input
                                    type="password"
                                    class="border-0 w-100"
                                    style="background-color: #f1f1f1; outline: none;"
                                    name="password"
                                    placeholder="*Heslo"
                                    value="{{old("password")}}"/>

                                <button type="button" class="btn border-0" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Heslo musí obsahovať aspoň 5 znakov, jedno veľké písmeno a jedno číslo.">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                            </div>
                            @error("password")
                                <p class="text-danger">Zlý formát hesla</p>
                            @enderror

                            <div class="d-flex justify-content-between mb-3 px-3 py-1 w-100" style="background-color: #f1f1f1; width: 400px;">
                                <input
                                    type="password"
                                    class="border-0 w-100"
                                    style="background-color: #f1f1f1; outline: none;"
                                    name="password_confirmation"
                                    placeholder="*Potvrďte Heslo"
                                    value="{{old("password_confirmation")}}"/>

                                <button type="button" class="btn border-0" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Heslo musí byť zhodné.">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                            </div>
                            @error("password_confirmation")
                                <p class="text-danger">Zlý formát hesla</p>
                            @enderror     

                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="border-0 rounded-5 px-5 py-2 mt-4 mb-5 d-flex justify-content-center align-items-center text-white" 
                                    style="min-width: 40%; min-height: 50px; padding: 6px 0 6px 0; background-color: #3bb397;">
                                    Zaregistrovať
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
        });
    </script>
</x-layout>