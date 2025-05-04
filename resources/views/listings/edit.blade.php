<x-layout>  
    {{-- <x-sidebar :categories="$categories"/> --}}

        <div class="d-flex justify-content-center p-0">
            <div class="container-fluid p-0" style="margin-top: 70px;">
                <div class="row d-flex align-items-center mx-3 mx-sm-5" style="height: 6vh;">
                    <div class="col-10 col-sm-11">
                        <h4 class="fw-bold mb-0">Upraviť Položku</h4>
                    </div>

                    <div class="col-2 col-sm-1 d-flex justify-content-end">
                        <a href="{{ url()->previous() }}" class="link">
                            <span class="d-flex justify-content-center align-items-center rounded-circle border border-black fs-4" style="height: 38px; width: 38px;">
                                <i class="bi bi-x-lg"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <form method="POST" action="/listing/manage/edit/{{$listing->id}}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="row border-top" style="min-height: 84vh;">
                        <div class="col-12 col-lg-9">
                            <div class="d-flex justify-content-center align-items-center flex-column" style="height: 100%;">
                                @if($listing->main_image)
                                    <div>
                                        <img src="{{ asset('storage/' . $listing->main_image) }}" alt="Main Image" style="width: 150px; height: auto; margin-bottom: 10px;">
                                    </div>
                                @endif
                        
                                <input name="main_image" type="file">
                                @error("main_image")
                                    <p class="text-danger">{{$message}}</p>  
                                @enderror
                        
                                @if($listing->image)
                                    @foreach(json_decode($listing->image, true) as $key => $image)
                                        <div style="margin-bottom: 10px;">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Image {{ $key + 1 }}" style="width: 100px; height: auto; margin-right: 10px;">
                                            <input type="checkbox" name="delete_images[]" value="{{ $key }}"> Delete
                                        </div>
                                    @endforeach
                                @endif
                        
                                <input name="image[]" type="file" multiple>
                                @error("image.*")
                                    <p class="text-danger">{{$message}}</p>  
                                @enderror
                            </div>
                        </div>
                        

                        <div class="col-12 col-lg-3 border-start pt-3">
                            <div class="d-flex flex-column justify-content-center">
                                <div>
                                    <input class="mb-3 border rounded px-3 py-3 w-100"
                                        type="text" 
                                        name="item_name"
                                        placeholder="Názov položky"
                                        value="{{$listing->item_name}}">

                                    @error("item_name")
                                        <p class="text-danger">{{$message}}</p>  
                                    @enderror
                                </div>


                                <div>
                                    <input class="mb-3 border rounded px-3 py-3 w-100"
                                        type="number" 
                                        name="price"
                                        placeholder="Cena"
                                        step="0.01" 
                                        min="0"
                                        value="{{$listing->price}}">
    
                                    @error("price")
                                        <p class="text-danger">{{$message}}</p>  
                                    @enderror
                                </div>

                                <div>
                                    <select class="form-select mb-3 px-3 py-3 w-100" name="category_id" style="color: grey;">
                                        <option selected disabled>Kategória</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
            
                                    @error("category_id")
                                        <p class="text-danger">{{$message}}</p>  
                                    @enderror
                                </div>

                                <div>
                                    <textarea class="rounded-2 border mb-3 w-100 px-3 py-3" placeholder="Popis..." name="description" rows="4" style="resize: none;">{{ old('description', $listing->description ?? '') }}</textarea>
                                    
                                    @error("description")
                                        <p class="text-danger">{{$message}}</p>  
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Location:</label>
                                    <div id="map" style="width: 100%; height: 300px;"></div>
                                    <input type="hidden" name="lat" id="lat" value="{{$listing->lat}}">
                                    <input type="hidden" name="lng" id="lng" value="{{$listing->lng}}">

                                    @error("lat")
                                        <p class="text-danger">{{$message}}</p>  
                                    @enderror
                                    @error("lng")
                                        <p class="text-danger">{{$message}}</p>  
                                    @enderror
                                </div>

                                <button type="submit" class="" style="">Potvrdiť zmeny</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</x-layout>