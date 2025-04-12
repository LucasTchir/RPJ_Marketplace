@props(['category'])

<div class="border border-black mx-2 mt-3 d-flex justify-content-center align-items-center flex-column" style="width: 128px; height: 128px;">
    <span class="fs-5">{!! $category->icon !!}</span>
    <p class="mb-0 fs-6">{{$category->category_name}}</p>
</div>
