{{--
    Customer shell: top navigation + page container.
    Child views fill @section('content') and may set:
      @section('title', '...')
      @section('page_class', 'page-narrow')   (optional width modifier)
--}}
@extends('layouts.app')

@section('body')

    <a href="#main" class="skip-link">Skip to content</a>

    <header class="site-header">

        <div class="site-header-inner">

            <a href="{{ route('vehicles.index') }}" class="brand">
                Rakz Rental
            </a>

            <nav class="nav" aria-label="Main">

                <a
                    href="{{ route('vehicles.index') }}"
                    class="{{ request()->routeIs('vehicles.*', 'bookings.create', 'bookings.store') ? 'active' : '' }}"
                >
                    Vehicles
                </a>

                @auth

                    <a
                        href="{{ route('bookings.index') }}"
                        class="{{ request()->routeIs('bookings.index') ? 'active' : '' }}"
                    >
                        Booking History
                    </a>

                    <a
                        href="{{ route('profile.show') }}"
                        class="{{ request()->routeIs('profile.*') ? 'active' : '' }}"
                    >
                        Profile
                    </a>

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>
                    @endif

                @endauth

            </nav>

            <div class="header-actions">

                @auth

                    <span class="header-user">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm">
                            Logout
                        </button>
                    </form>

                @else

                    <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                        Sign Up
                    </a>

                @endauth

            </div>

        </div>

    </header>

    <main id="main" class="page @yield('page_class')">
        @yield('content')
    </main>

@endsection
