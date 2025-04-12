<x-layout>
    <x-sidebar :categories="$categories"/>
    <div class="navbar-wrapper">
        <x-navbar :categories="$categories"/>
    </div>

    <div class="content" id="content" style="padding-top: 130px; height: 100% !important;">
        <div class="container" style="max-width: 1700px;">
            <div class="row mt-4">
                <div class="col-12 col-md-6">
                    <h4 class="fw-bold border-bottom pb-2">Správy</h4>

                    <div style="width: 100%;">
                        @if (auth()->check())
                            @unless(count($messages) == 0)
                                @foreach ($messages as $message)
                                    <x-message :message="$message" />
                                @endforeach
                            @else
                                <p class="card-text m-0 text-center ms-3">Žiadne správy.</p>
                            @endunless
                        @else
                            <p class="card-text m-0 text-start ms-3">Pre zobrazenie správ sa prosím prihláste.</p>
                        @endif
                    </div>
                </div>

                <div class="col-0 col-md-1">

                </div>

                <div class="col-12 col-md-5">
                    <h4 class="fw-bold border-bottom pb-2">Upozornenia</h4>

                    <div class="" style="width: 100%;">
                        @if (auth()->check())
                            @unless(count($notifications) == 0)
                                @foreach ($notifications as $notification)
                                    <x-notification :notification="$notification" />
                                @endforeach
                            @else
                                <p class="card-text m-0 text-center ms-3">Žiadne upozornenia.</p>
                            @endunless
                        @else
                            <p class="card-text m-0 text-start ms-3">Pre zobrazenie upozornení sa prosím prihláste.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>