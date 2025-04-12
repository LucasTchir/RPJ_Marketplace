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
                <h4 class="fw-bold mb-0">Spravovať použivateľov</h4>
            </div>

            {{-- <div class="col-12 col-sm-3 d-flex justify-content-between justify-content-sm-end">
                <a href="{{ url()->previous() }}" class="link ms-4">
                    <span class="d-flex justify-content-center align-items-center rounded-circle border border-black fs-4" style="height: 38px; width: 38px;">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </a>
            </div> --}}
        </div>
            @unless(count($users) == 0)
            @foreach ($users as $user)
                <div class="row border p-1 d-flex align-items-center">
                    <div class="col-3">
                        <span>
                            @if ($user->photo)
                                <a href=""><img class="rounded-circle img-fit" style="max-width: 50px; max-height: 50px;" src="{{$user->photo ? asset("storage/" . $user->photo) : asset("/images/blank-profile-picture.png")}}" alt="User photo"></a>
                            @endif
                        </span>
                    </div>

                    <div class="col-3">
                        <span class="fw-semibold">Meno: </span> <span>{{$user->name}}</span>
                    </div>
                    

                    <div class="col-3">
                        <span class="fw-semibold">Vytvorený: </span> <span>{{$user->created_at->format('d.m.Y');}}</span>
                    </div>

                    <div class="col-3 d-flex justify-content-around flex-wrap">
                        <form method="POST" action="/dashboard/delete/users/{{$user->id}}">
                            @csrf
                            @method("DELETE")
                            <button class="btn text-white bg-danger border-danger">VYMAZAŤ</button>
                        </form>

                        <a href="/dashboard/edit/profile/{{$user->id}}" class="btn text-white bg-warning border-warning">UPRAVIŤ</a>
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-center mt-3">
                {{ $users->links() }}
            </div>

            @else
                <p>Žiadny nájdený použivatelia</p>
            @endunless
    </div>
</x-layout>