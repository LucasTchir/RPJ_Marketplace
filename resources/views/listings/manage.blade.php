<x-layout>
    <x-sidebar :categories="$categories"/>
    
    <div class="container" style="margin-top: 70px;">
        <div class="row d-flex align-items-center mb-3" style="height: 8vh;">
            <div class="col-12 col-sm-9 text-center text-sm-start mb-2">
                <h4 class="fw-bold mb-0"><a href="/users/{{auth()->user()->username}}" class="link" style="color: darkgrey;">Profil > </a>Spravovať Inzeráty</h4>
            </div>

            <div class="col-12 col-sm-3 d-flex justify-content-between justify-content-sm-end">
                <a href="/create" class="link border-0">
                    <span class="rounded-5 px-2 d-flex justify-content-center align-items-center bg-green" style="min-width: 150px; padding: 6px 0 6px 0; background-color: #d9f2ec;">
                        Vytvoriť inzerát
                    </span>
                </a>

                <a href="{{ url()->previous() }}" class="link ms-4">
                    <span class="d-flex justify-content-center align-items-center rounded-circle border border-black fs-4" style="height: 38px; width: 38px;">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </a>
            </div>
        </div>

        <div>
            @unless(count($listings) == 0)
            @foreach ($listings as $listing)
                <div class="row border p-1 d-flex align-items-center">
                    <div class="col-3">
                        <span>
                            @if ($listing->main_image)
                                <a href=""><img class="rounded-2 img-fit" style="max-width: 40%; max-height: 100px;" src="{{ asset('storage/' . $listing->main_image) }}" alt="Posting image"></a>
                            @endif
                        </span>
                    </div>

                    <div class="col-3">
                        <span class="fw-semibold">Názov položky: </span> <span>{{$listing->item_name}}</span>
                    </div>
                    

                    <div class="col-3">
                        <span class="fw-semibold">Vytvorený: </span> <span>{{$listing->created_at->format('d.m.Y');}}</span>
                    </div>

                    <div class="col-3 d-flex justify-content-around flex-wrap">
                        <form method="POST" action="/profile/delete/{{$listing->id}}">
                            @csrf
                            @method("DELETE")
                            <button class="btn text-white bg-danger border-danger">VYMAZAŤ</button>
                        </form>

                        <a href="/listing/edit/{{$listing->id}}" class="btn text-white bg-warning border-warning">UPRAVIŤ</a>
                    </div>
                </div>
            @endforeach
            @else
            <p>Žiadne najdené inzeráty</p>
            @endunless
        </div>
    </div>
</x-layout>