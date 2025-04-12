<x-layout>
    <div class="content" id="content" style="padding-top: 50px;">
        <div class="container p-5">
            <div class="border-bottom border-2 d-flex justify-content-start">
                <h2 class="text-start fw-bold mb-3 fs-3"><a href="/users/{{auth()->user()->username}}" class="link" style="color: darkgrey;">Profil > </a>Zmena Hesla</h2>
            </div>

            @if($errors->any())
                {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
            @endif

            @if(Session::get('error') && Session::get('error') != null)
                <div style="color:red">{{ Session::get('error') }}</div>
                @php
                Session::put('error', null)
                @endphp
            @endif

            @if(Session::get('success') && Session::get('success') != null)
                <div style="color:green">{{ Session::get('success') }}</div>
                @php
                Session::put('success', null)
                @endphp
            @endif

                <form class="form p-4 mt-4" action="/change-password-save" method="POST" style="width: 100%; max-width: 400px; margin: 0 auto;">
                    @csrf
            
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Aktuálne heslo</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
            
                    <div class="mb-3">
                        <label for="new_password" class="form-label fw-semibold">Nové heslo</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
            
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label fw-semibold">Potvrdiť nové heslo</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
            
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn bg-green w-50 text-center px-3 py-2 fw-bold" style="background-color: #d9f2ec;">Uložiť heslo</button>
                    </div>
                </form>
                      
        </div>
    </div>
</x-layout>
