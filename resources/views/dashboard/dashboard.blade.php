<x-layout>

    <x-sidebar-dashboard :categories="$categories"/>
    <div class="navbar-wrapper">
        <x-navbar :categories="$categories"/>
    </div>
    <div class="navbar-wrapper">
        <x-navbar-dashboard />
    </div>
    
    <div class="content px-2" id="content" style="padding-top: 142px;">
        Dashboard
    </div>
</x-layout>