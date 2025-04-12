<x-layout>  
    {{-- <x-sidebar :categories="$categories"/> --}}

        <div class="d-flex justify-content-center p-0">
            <div class="container-fluid p-0" style="margin-top: 70px;">
                <div class="row d-flex align-items-center mx-3 mx-sm-5" style="height: 6vh;">
                    <div class="col-10 col-sm-11">
                        <h4 class="fw-bold mb-0">Edit Listing</h4>
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
                            <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                                <input class="" name="main_image" type="file" value="{{$listing->main_image}}">
                                @error("main_image")
                                    <p class="text-danger">{{$message}}</p>  
                                @enderror

                                <input class="" name="image[]" type="file" multiple value="{{$listing->image}}">
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
                                        placeholder="Item Name"
                                        value="{{$listing->item_name}}">

                                    @error("item_name")
                                        <p class="text-danger">{{$message}}</p>  
                                    @enderror
                                </div>


                                <div>
                                    <input class="mb-3 border rounded px-3 py-3 w-100"
                                        type="number" 
                                        name="price"
                                        placeholder="Price"
                                        step="0.01" 
                                        min="0"
                                        value="{{$listing->price}}">
    
                                    @error("price")
                                        <p class="text-danger">{{$message}}</p>  
                                    @enderror
                                </div>

                                <div>
                                    <select class="form-select mb-3 px-3 py-3 w-100" name="category_id" style="color: grey;">
                                        <option selected disabled>Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
            
                                    @error("category_id")
                                        <p class="text-danger">{{$message}}</p>  
                                    @enderror
                                </div>

                                <div>
                                    <select class="form-select mb-3 px-3 py-3 w-100" name="condition" style="color: grey;">
                                        <option value="1" selected disabled>Condition</option>
                                        <option value="2">New</option>
                                        <option value="3">Used - as new</option>
                                        <option value="4">Used - in good condition</option>
                                        <option value="5">Used - in fair condition</option>
                                    </select>
            
                                    @error("condition")
                                        <p class="text-danger">{{$message}}</p>  
                                    @enderror
                                </div>

                                <div>
                                    <input class="mb-3 border rounded px-3 py-3 w-100"
                                        type="number" 
                                        name="quantity"
                                        placeholder="Quantity"
                                        value="{{$listing->quantity}}">
    
                                    @error("quantity")
                                        <p class="text-danger">{{$message}}</p>  
                                    @enderror
                                </div>

                                <div>
                                    <textarea class="rounded-2 border mb-3 w-100 px-3 py-3" placeholder="Description..." name="description" rows="4" style="resize: none;">{{ old('description', $listing->description ?? '') }}</textarea>
                                    
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

                                <button type="submit" class="" style="">EDIT</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</x-layout>