@if (session()->has("message"))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed-bottom text-center fw-semibold" style="background-color: #c2efc2;">
        {{session("message")}}
    </div>
@endif