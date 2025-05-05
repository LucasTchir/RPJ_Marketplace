<x-layout>
    <div class="content" id="content" style="padding-top: 50px;">
        <div class="container p-5">
            <div class="border-bottom border-2 d-flex justify-content-between">
                <h2 class="text-start fw-bold mb-3 fs-3"><a href="/dashboard" class="link" style="color: darkgrey;">Ovladací panel > </a>Upraviť profil</h2>
            </div>

            <form method="POST" action="/dashboard/profile/{{$user->id}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <!-- Profilová fotka -->
                <div class="mb-4">
                    <div class="mt-3 d-flex justify-content-center">
                        <img 
                            class="rounded-circle img-thumbnail" 
                            src="{{$user->photo ? asset('storage/' . $user->photo) : asset('/images/blank-profile-picture.png')}}" 
                            alt="Profilová fotka" 
                            style="width: 150px; height: 150px;"
                        />
                    </div>
                    <label for="photo" class="form-label fw-semibold">Profilová Fotka</label>
                    <input 
                        name="photo" 
                        type="file" 
                        class="form-control @error('photo') is-invalid @enderror"
                    />
                    @error("photo")
                        <p class="text-danger mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <!-- Meno -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Meno</label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                name="name" 
                                value="{{$user->name}}"
                            />
                            @error("name")
                                <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email" 
                                value="{{$user->email}}"
                            />
                            @error("email")
                                <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <!-- Popis -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Popis</label>
                            <textarea 
                                name="description" 
                                class="form-control @error('description') is-invalid @enderror" 
                                rows="8" 
                                style="resize: none;"
                            >{{$user->description}}</textarea>
                            @error("description")
                                <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn bg-green px-5 py-2 fw-bold" style="background-color: #d9f2ec;">Uložiť</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
