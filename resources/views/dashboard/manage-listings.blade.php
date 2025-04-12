<x-layout>

    <x-sidebar-dashboard :categories="$categories"/>
    <div class="navbar-wrapper">
        <x-navbar :categories="$categories"/>
    </div>
    <div class="navbar-wrapper">
        <x-navbar-dashboard />
    </div>

        <div class="container" style="padding-top: 165px;">
            <div class="row d-flex align-items-center" style="height: 6vh;">
                <div class="col-12 col-sm-9 text-center text-sm-start">
                    <h4 class="fw-bold mb-0">Spravovať inzeráty</h4>
                </div>
    
                {{-- <div class="col-12 col-sm-3 d-flex justify-content-between justify-content-sm-end">
                    <a href="{{ url()->previous() }}" class="link ms-4">
                        <span class="d-flex justify-content-center align-items-center rounded-circle border border-black fs-4" style="height: 38px; width: 38px;">
                            <i class="bi bi-x-lg"></i>
                        </span>
                    </a>
                </div> --}}
            </div>
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
        
                            <div class="col-4">
                                <span class="fw-semibold">Názov položky: </span> <span>{{$listing->item_name}}</span>
                            </div>
                            
        
                            <div class="col-3">
                                <span class="fw-semibold">Vytvorený: </span> <span>{{$listing->created_at->format('d.m.Y');}}</span>
                            </div>
        
                            <div class="col-2 d-flex justify-content-around flex-wrap">
                                <form method="POST" action="/dashboard/delete/listings/{{$listing->id}}">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn text-white bg-danger border-danger mb-1">VYMAZAŤ</button>
                                </form>

                                <a href="/dashboard/edit/listing/{{$listing->id}}" class="btn text-white bg-warning border-warning">UPRAVIŤ</a>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-center mt-3">
                            {{ $listings->links() }}
                    </div>
                @else
                    <p>Žiadne najdené inzeráty</p>
                @endunless
        </div>
</x-layout>