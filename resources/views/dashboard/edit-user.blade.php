<x-layout>
    <form method="POST" action="/dashboard/profile/{{$user->id}}" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="">
            <label for="name" class="">
                Name
            </label><br>
            <input
                type="text"
                class=""
                name="name"
                value="{{$user->name}}"
            />

            @error("name")
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div><br>

        <div class="">
            <label for="email" class=""
                >Email</label
            ><br>
            <input
                type="email"
                class=""
                name="email"
                value="{{$user->email}}"
            />

            @error("email")
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div><br>

        <div>
            <label for="description">Description</label><br>
            <textarea name="description" cols="30" rows="10">{{$user->description}}</textarea>

            @error("description")
                <p class="text-danger">{{$message}}</p>  
            @enderror
        </div><br>

        <div>
            <label for="photo">Profile Picture</label><br>
            <input name="photo" type="file">

            <img
                class="w-25"
                src="{{$user->photo ? asset("storage/" . $user->photo) : asset("/images/blank-profile-picture.png")}}"
                alt=""
            />

            @error("photo")
                <p class="text-danger">{{$message}}</p>  
            @enderror
        </div><br>

        <div class="">
            <button
                class=""
            >
                Save
            </button><br>
        </div>
    </form>
</x-layout>