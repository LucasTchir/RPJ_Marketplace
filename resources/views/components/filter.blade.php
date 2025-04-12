@props(['category'])

<div class="d-flex justify-content-center py-2 px-1 flex-wrap" style="width: 100%;">
    <div class="d-flex" style="width: 20%; min-width: 200px;">
        <form action="/category/{{$category->id}}" class="d-flex w-100">
            <input type="text" name="search" class="border form-control py-1 rounded-0" 
            style="background-color: #fff; height: 38px;" placeholder="Hľadať..." value="{{request('search')}}">
    </div>

    <div class="d-flex" style="width: 20%; min-width: 200px;">
        <select name="order" class="form-select py-1 px-3 d-flex align-items-center fw-semibold m-0 rounded-0" 
        style="background-color: #fff; height: 38px; font-size: 14px; color: #595959;">
            <option value="latest" {{ request('order') == 'latest' ? 'selected' : '' }}>Najnovšie</option>
            <option value="low_to_high" {{ request('order') == 'low_to_high' ? 'selected' : '' }}>Najlacnejšie</option>
            <option value="high_to_low" {{ request('order') == 'high_to_low' ? 'selected' : '' }}>Najdrahšie</option>
        </select>
    </div>

    <div class="d-flex" style="width: 20%; min-width: 200px;">
        <input type="text" name="min" class="form-control border rounded-0" 
        style="background-color: #fff; height: 38px;" 
        placeholder="Minimum" value="{{request('min')}}">
    </div>

    <div class="d-flex" style="width: 20%; min-width: 200px;">
        <input type="text" name="max" class="form-control border rounded-0" 
        style="background-color: #fff; height: 38px;" 
        placeholder="Maximum" value="{{request('max')}}">
    </div>

    <div class="d-flex" style="width: 20%; min-width: 200px;">
        <button type="submit" class="btn w-100 m-0 fw-semibold border-1 rounded-0" 
        style="border-color: #000; background-color: #fff; height: 38px; font-size: 14px; color: #000;">
            <i class="bi bi-search text-dark pe-2"></i>Filtrovať
        </button>
    </form>
    </div>
</div>
