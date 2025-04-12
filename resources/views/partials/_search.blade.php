<div class="d-flex justify-content-center align-items-center search" style="height: 38vh !important; background-image: url('{{ asset('images/sliderbg1.jpg') }}'); background-size: cover; background-position: center; -webkit-box-shadow: inset 0px 0px 10px 2px rgba(0,0,0,0.75); -moz-box-shadow: inset 0px 0px 10px 2px rgba(0,0,0,0.75); box-shadow: inset 0px 0px 10px 2px rgba(0,0,0,0.75);">
    <div class="d-flex flex-column align-items-center">
        <div class="d-flex text-center">
            <h4 class="text-white fw-bold pb-3 fs-2">Čo môžeme pre vás nájsť?</h4>
        </div>

        <form action="/" class="d-flex" style="width: 80%;">
            <input type="text" name="search" class="border-0 form-control rounded-start-5 py-1 box-shadow" 
            style="font-size: 14px; height: 40px; border-radius: 5px 0 0 5px; background-color: #f2f2f2;" placeholder="Hľadať..." value="{{request("search")}}">
    
            <button type="submit" class="btn rounded-end-5 px-3" 
            style="border-radius: 0 5px 5px 0; height: 40px; background-color: #f2f2f2;"><i class="bi bi-search text-dark "></i></button>
        </form>
    </div>
</div>
