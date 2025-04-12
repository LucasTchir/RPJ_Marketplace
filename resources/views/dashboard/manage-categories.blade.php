<x-layout>

    <x-sidebar-dashboard :categories="$categories"/>
    <div class="navbar-wrapper">
        <x-navbar :categories="$categories"/>
    </div>
    <div class="navbar-wrapper">
        <x-navbar-dashboard />
    </div>

    <div class="container" style="padding-top: 165px;">
        <div class="row d-flex align-items-center mb-3 mt-3" style="">
            <div class="col-12 col-sm-10 text-center text-sm-start mb-3">
                <h4 class="fw-bold mb-0">Spravovať Inzeráty</h4>
            </div>

            <a href="/category/create/new" class="col-12 col-sm-2 link border-0">
                <span class="rounded-5 px-2 d-flex justify-content-center align-items-center bg-green" style="min-width: 120px; padding: 6px 0 6px 0; background-color: #d9f2ec;">
                    Vytvoriť kategóriu
                </span>
            </a>
        </div> 

        <div>
            @unless(count($categories) == 0)
            @foreach ($categories as $category)
                <div class="row border p-1 d-flex align-items-center">
                    <div class="col-2">
                        <span>
                            <span class="fw-semibold">{!! $category->icon !!}</span>
                        </span>
                    </div>

                    <div class="col-4">
                        <span class="fw-semibold">Kategória: </span> <span>{{$category->category_name}}</span>
                    </div>
                    

                    <div class="col-4">
                        <span class="fw-semibold">Vytvorená: </span> <span>{{$category->created_at->format('d.m.Y');}}</span>
                    </div>

                    <div class="col-2">
                        <form method="POST" action="/dashboard/delete/categories/{{$category->id}}">
                            @csrf
                            @method("DELETE")
                            <button class="btn text-white bg-danger border-danger">VYMAZAŤ</button>
                        </form>
                    </div>
                </div>
            @endforeach
            @else
                <p>Žiadne najdené inzeráty.</p>
            @endunless
        </div>
    </div>
</x-layout>