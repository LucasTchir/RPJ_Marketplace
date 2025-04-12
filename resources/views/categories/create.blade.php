<x-layout>
    <x-navbar :categories="$categories" />
    <x-navbar-dashboard />

    <div class="container" style="padding-top: 180px;">
        <form method="POST" action="/category/new" enctype="multipart/form-data">
            @csrf
                        <div class="row" style="min-height: 84vh;">
                            <div class="col-12 col-lg-3 pt-3" style="margin: 0 auto;">
                                <div class="d-flex flex-column justify-content-center">
                                    <div>
                                        <input class="mb-3 border rounded px-3 py-3 w-100"
                                            type="text" 
                                            name="category_name"
                                            placeholder="Meno kategórie">

                                        @error("category_name")
                                            <p class="text-danger">{{$message}}</p>  
                                        @enderror
                                    </div>

                                    <div>
                                        <input class="mb-3 border rounded px-3 py-3 w-100"
                                            type="text" 
                                            name="icon"
                                            placeholder="Ikona">

                                        @error("icon")
                                            <p class="text-danger">{{$message}}</p>  
                                        @enderror
                                    </div>

                                    <button type="submit" class="" style="">Vytvoriť</button>
                                </div>
                            </div>
                        </div>
                    </form>
    </div>
</x-layout>