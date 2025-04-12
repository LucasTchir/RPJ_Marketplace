<x-layout>
    <x-sidebar :categories="$categories"/>
    <div class="navbar-wrapper">
        <x-navbar :categories="$categories"/>
    </div>

    <div class="content" id="content" style="padding-top: 130px;">
        <div class="container">
            @foreach ($users as $user)
                <a href="/users/{{$user->username}}" class="link"><p>{{$user->name}}</p></a>
            @endforeach
        </div>
    </div>
</x-layout>