{{-- Login / register shell: brand panel + form panel. --}}
@extends('layouts.app')

@section('body')

    <div class="auth-shell">

        <aside class="auth-aside">

            <a href="{{ route('vehicles.index') }}" class="brand">
                Rakz Rental
            </a>

            <p>
                Browse the fleet, book your dates and keep track of every rental in one place.
            </p>

        </aside>

        <main id="main" class="auth-main">

            <div class="auth-panel">
                @yield('content')
            </div>

        </main>

    </div>

@endsection
