<x-layout>
    <x-sidebar :categories="$categories"/>
    <div class="navbar-wrapper">
        <x-navbar :categories="$categories"/>
    </div>

    <div class="content" id="content" style="padding-top: 130px;">
        <div class="px-4">
            <div class="mt-4">
                <div class="" style="max-width: 1710px; margin: 0 auto;">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold" style="font-size: 24px;">Výsledky pre "{{$searchQuery}}"</span>
                    </div>

                    <div class="row d-flex justify-content-center justify-content-sm-start px-1 px-sm-5">
                        @forelse ($listings as $listing)
                            <x-listing :listing="$listing"/>
                        @empty
                            <p>V tejto kategórii nie sú dostupné žiadne inzeráty.</p>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $listings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>