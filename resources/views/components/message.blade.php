@props(["message"])

<div class="card border-0 custom-bg mb-2 ms-3 py-2 px-3" style="background-color: #e6e6e6;">
    <div class="card-body text-start p-0">
        <div class="row">
            <div class="col-10">
                <p class="card-text m-0"><a class="link-underline link-underline-opacity-0 text-dark fw-semibold" href="/users/{{$message->user->username}}">{{$message->user->name}}</a> {{$message->description}}</p> 
                <p class="card-text" style="font-size: 11px; color: #8c8c8c;">{{$message->created_at->diffForHumans()}}</p>
            </div>

            <div class="col-2">
                <form method="POST" action="/message/delete/{{$message->id}}">
                    @csrf
                    @method("DELETE")
                    <div class="delete-button-container text-end">
                        <button class="btn-close delete-button"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>