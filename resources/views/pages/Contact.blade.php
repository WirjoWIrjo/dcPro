{{-- --------------------------------------------------------------
    resources/views/contact.blade.php
    --------------------------------------------------------------
    Contact‑page view.
    • Extends the global layout (app.blade.php).  
    • Sets a simple page title.  
    • Renders a Bootstrap‑styled form.
    -------------------------------------------------------------- --}}

{{-- --------------------------------------------------------------
    1️⃣  Extend the base layout
    -------------------------------------------------------------- --}}
@extends('layouts.app')

{{-- --------------------------------------------------------------
    2️⃣  Page title – used in the <title> tag of the layout
    -------------------------------------------------------------- --}}
@section('title', 'Contact')

{{-- --------------------------------------------------------------
    3️⃣  Main content section – the layout yields this where it calls
        @yield('content')
    -------------------------------------------------------------- --}}
@section('content')

    {{-- ----------------------------------------------------------
        Container – adds left/right padding and a top margin
        ---------------------------------------------------------- --}}
    <div class="container mt-4">

        {{-- Page heading --}}
        <h1>Contact</h1>

        {{-- ------------------------------------------------------
            Contact form
            ------------------------------------------------------ --}}
        <form>

            {{-- --------------------------------------------------
                Nama (Name) field
                -------------------------------------------------- --}}
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text"
                    class="form-control"
                    {{-- Optional: preserve old input after validation errors --}}
                    {{-- value="{{ old('name') }}" --}}
                >
            </div>

            {{-- --------------------------------------------------
                Email field
                -------------------------------------------------- --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                    class="form-control"
                    {{-- value="{{ old('email') }}" --}}
                >
            </div>

            {{-- --------------------------------------------------
                Pesan (Message) textarea
                -------------------------------------------------- --}}
            <div class="mb-3">
                <label class="form-label">Pesan</label>
                <textarea class="form-control"
                        {{-- rows="5" --}}
                        {{-- {{ old('message') }} --}}
                ></textarea>
            </div>

            {{-- --------------------------------------------------
                Submit button
                -------------------------------------------------- --}}
            <button type="submit"
                    class="btn btn-primary">
                Kirim
            </button>

            {{-- --------------------------------------------------
                NOTE:
                • In a real‑world app you should add:
                – method="POST"
                – action="{{ route('contact.store') }}" (or whatever route you use)
                – @csrf token for protection against Cross‑Site Request Forgery
                – server‑side validation and error display
                -------------------------------------------------- --}}

        </form>
    </div> {{-- /.container --}}

@endsection {{-- end of content section --}}