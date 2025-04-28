<x-layout>  
        <x-sidebar :categories="$categories"/>

            <div class="d-flex justify-content-center p-0">
                <div class="container-fluid p-0" style="margin-top: 70px;">
                    <div class="row d-flex align-items-center mx-3 mx-sm-5" style="height: 6vh;">
                        <div class="col-10 col-sm-11">
                            <h4 class="fw-bold mb-0">Predať položku</h4>
                        </div>

                        <div class="col-2 col-sm-1 d-flex justify-content-end">
                            <a href="{{ url()->previous() }}" class="link">
                                <span class="d-flex justify-content-center align-items-center rounded-circle border border-black fs-4" style="height: 38px; width: 38px;">
                                    <i class="bi bi-x-lg"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <form method="POST" action="/home" enctype="multipart/form-data">
                        @csrf
                        <div class="row border-top" style="min-height: 84vh;">
                            <div class="col-12 col-lg-9">
                                <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                                    <input class="" name="main_image" type="file">
                                    @error("main_image")
                                        <p class="text-danger">{{$message}}</p>  
                                    @enderror

                                    <input class="" name="image[]" type="file" multiple>
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
                                            value="{{ old('item_name') }}"
                                            placeholder="Názov položky">

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
                                            value="{{ old('price') }}"
                                            min="0">
        
                                        @error("price")
                                            <p class="text-danger">{{$message}}</p>  
                                        @enderror
                                    </div>

                                    <div>
                                        <select class="form-select mb-3 px-3 py-3 w-100" name="category_id" style="color: grey;">
                                            <option value="" selected disabled>Kategória</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                
                                        @error("category_id")
                                            <p class="text-danger">{{$message}}</p>  
                                        @enderror
                                    </div>

                                    {{-- <div>
                                        <select class="form-select mb-3 px-3 py-3 w-100" name="condition" style="color: grey;">
                                            <option value="1" selected disabled>Kondícia</option>
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
                                            placeholder="Množstvo">
        
                                        @error("quantity")
                                            <p class="text-danger">{{$message}}</p>  
                                        @enderror
                                    </div> --}}

                                    <div>
                                        <textarea class="rounded-2 border mb-3 w-100 px-3 py-3" placeholder="Popis..." name="description" rows="4" style="resize: none;" {{ old('description') }}></textarea>

                                        @error("description")
                                            <p class="text-danger">{{$message}}</p>  
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Location:</label>
                                        <div id="map" style="width: 100%; height: 300px;"></div>
                                        <input type="hidden" name="lat" id="lat" value="{{ old('lat') }}">
                                        <input type="hidden" name="lng" id="lng" value="{{ old('lat') }}">

                                        @error("lat")
                                            <p class="text-danger">{{$message}}</p>  
                                        @enderror
                                        @error("lng")
                                            <p class="text-danger">{{$message}}</p>  
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn bg-green w-100 py-2 fw-bold rounded-3 shadow-sm">
                                        <i class="bi bi-plus-circle me-2"></i> Vytvoriť Inzerát
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</x-layout>