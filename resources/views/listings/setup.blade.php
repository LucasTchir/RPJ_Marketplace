<x-layout>
    <div class="content" id="content" style="padding-top: 130px;">
        <div class="container">
            <div x-data="{ currentStep: 'start' }">

                {{-- ------------------------------- Start ------------------------------- --}}
                <div x-show="currentStep === 'start'">
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <div class="">
                            <p class="fs-2">Pred začiatkom si prosím nastavte svoj profil.</p>

                            <div class="d-flex flex-column align-items-center">
                                <button type="button" @click="currentStep = 'profile'" :class="{ 'font-bold': currentStep === 'profile' }" class="btn rounded-3 px-3 d-flex justify-content-center align-items-center fw-semibold" 
                                style="max-width: 120px; padding: 5px 0 5px 0; background-color: #e6e6e6;">
                                    Pokračovať
                                </button>
        
                                <a href="/" class="link mt-3 d-flex justify-content-center align-items-center fw-semibold" style="max-width: 120px; font-size: 14px; color: #4d4d4d;">
                                    Preskočiť
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ------------------------------- Začiatok Formulára ------------------------------- --}}
                <form method="POST" action="/setup/store/{{$user->id}}" enctype="multipart/form-data">
                    @csrf

                    {{-- ------------------------------- Profil ------------------------------- --}}
                    <div x-show="currentStep === 'profile'">
                        <div class="d-flex justify-content-center">
                            <div class="row w-75 d-flex align-items-center border-bottom border-black" style="height: 8vh;">
                                <div class="col-12 col-sm-9 text-center text-sm-start">
                                    <h4 class="fw-bold mb-0 fs-3">Nastav si svoj profil</h4>
                                </div>
                    
                                <div class="col-12 col-sm-3 d-flex justify-content-between justify-content-sm-end">
                                    <button type="button" @click="currentStep = 'location'" :class="{ 'font-bold': currentStep === 'location' }" class="btn rounded-5 px-2 d-flex justify-content-center align-items-center fw-semibold" style="min-width: 120px; padding: 5px 0 5px 0; background-color: #f2f2f2; border-color: #595959;">
                                        Pokračovať
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2 d-flex justify-content-center">
                            <div class="w-75 row g-3">
                                <div class="col-12 col-md-6 p-3">
                                    <div class="mb-3">
                                        <label for="photo" class="form-label fw-bold">Profilová fotka</label>
                                    </div>

                                    <div class="text-center">
                                        <img 
                                            class="img-thumbnail w-50" 
                                            src="{{$user->photo ? asset('storage/' . $user->photo) : asset('/images/blank-profile-picture.png')}}" 
                                            alt="Profile Picture"
                                        />
                                    </div>

                                    <div class="mt-4">
                                        <input name="photo" type="file" class="form-control">
                                    </div>

                                    @error('photo')
                                        <p class="text-danger mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                        
                                <div class="col-12 col-md-6 p-3">
                                    <div class="mb-4">
                                        <label for="phone" class="form-label fw-bold">Telefónne číslo</label>
                                        <input 
                                            type="tel" 
                                            class="form-control" 
                                            name="phone"  
                                            value="{{$user->phone}}" 
                                            pattern="\+4219[ ]?[0-9]{2}[ ]?[0-9]{3}[ ]?[0-9]{3}" 
                                        />

                                        @error('phone')
                                            <p class="text-danger mt-2">{{$message}}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="description" class="form-label fw-bold">Popis:</label>
                                        <textarea 
                                            name="description" 
                                            class="form-control" 
                                            rows="5">{{$user->description}}</textarea>

                                        @error('description')
                                            <p class="text-danger mt-2">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ------------------------------- Oblast ------------------------------- --}}
                    <div x-show="currentStep === 'location'">
                        <div class="d-flex justify-content-center">
                            <div class="row w-75 d-flex align-items-center border-bottom border-black" style="height: 8vh;">
                                <div class="col-12 col-sm-9 text-center text-sm-start">
                                    <h4 class="fw-bold mb-0 fs-3">Vyber si oblasť, v ktorej ti pomôžeme nájsť čo ťa zaujíma</h4>
                                </div>
                        
                                <div class="col-12 col-sm-3 d-flex justify-content-between justify-content-sm-end">
                                    <button type="button" @click="currentStep = 'profile'" :class="{ 'font-bold': currentStep === 'profile' }"  class="btn rounded-5 px-2 d-flex justify-content-center align-items-center fw-semibold me-2" style="min-width: 80px; padding: 5px 0 5px 0; background-color: #f2f2f2; border-color: #595959;">
                                        Spať
                                    </button>

                                    <button type="button" @click="currentStep = 'categories'" :class="{ 'font-bold': currentStep === 'categories' }"  class="btn rounded-5 px-2 d-flex justify-content-center align-items-center fw-semibold" style="min-width: 120px; padding: 5px 0 5px 0; background-color: #f2f2f2; border-color: #595959;">
                                        Pokračovať
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="d-flex align-items-center flex-column">
                                <div id="map" style="width: 70%; height: 300px;"></div>
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">
                            </div>
                        </div>
                    </div>

                    {{-- ------------------------------- Kategorie ------------------------------- --}}
                    <div x-show="currentStep === 'categories'">
                        <div class="d-flex justify-content-center">
                            <div class="row w-75 d-flex align-items-center border-bottom border-black" style="height: 8vh;">
                                <div class="col-12 col-sm-9 text-center text-sm-start">
                                    <h4 class="fw-bold mb-0 fs-3">Vyber si čo ťa najviac zaujíma</h4>
                                </div>
                        
                                <div class="col-12 col-sm-3 d-flex justify-content-between justify-content-sm-end">
                                    <button type="button" @click="currentStep = 'location'" :class="{ 'font-bold': currentStep === 'location' }"  class="btn rounded-5 px-2 d-flex justify-content-center align-items-center fw-semibold me-2" style="min-width: 80px; padding: 5px 0 5px 0; background-color: #f2f2f2; border-color: #595959;">
                                        Spať
                                    </button>

                                    <button type="submit" class="btn rounded-5 px-2 d-flex justify-content-center align-items-center fw-semibold" style="min-width: 120px; padding: 5px 0 5px 0; background-color: #f2f2f2; border-color: #595959;">
                                        Dokončiť
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-2">
                            <div class="w-75 d-flex justify-content-around flex-wrap">
                                @foreach ($categories as $category)
                                    @php
                                        $isChecked = $selectedCategories->contains($category->id);
                                    @endphp

                                    <label class="category-card border rounded-3 mx-2 mt-3 d-flex justify-content-center align-items-center flex-column
                                        {{ $isChecked ? 'selected' : '' }}" 
                                        style="width: 128px; height: 128px;"
                                        data-id="{{ $category->id }}">

                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="d-none"
                                            {{ $isChecked ? 'checked' : '' }}>
                                        
                                        <span class="fs-5 icon" style="color: {{ $isChecked ? 'black' : '#ccc' }};">{!! $category->icon !!}</span>
                                        
                                        <p class="mb-0 fs-6 text" style="color: {{ $isChecked ? 'black' : '#ccc' }};">{{ $category->category_name }}</p>

                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form> {{-- KONIEC FORMULARA --}}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".category-card").forEach(card => {
                let checkbox = card.querySelector("input[type='checkbox']");
                let categoryId = card.getAttribute("data-id");
    
                card.addEventListener("click", function () {
                    checkbox.checked = !checkbox.checked;
    
                    if (checkbox.checked) {
                        card.classList.add("selected");
                        card.style.borderColor = "black";
                        card.querySelector(".icon").style.color = "black";
                        card.querySelector(".text").style.color = "black";
                    } else {
                        card.classList.remove("selected");
                        card.style.borderColor = "#ccc";
                        card.querySelector(".icon").style.color = "#ccc";
                        card.querySelector(".text").style.color = "#ccc";
                    }
    
                    updateCategorySelection(categoryId, checkbox.checked);
                });
            });
    
            function updateCategorySelection(categoryId, isSelected) {
                fetch("{{ route('categories.updateSelection') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ category_id: categoryId, selected: isSelected })
                });
            }
        });
    </script>
</x-layout>
