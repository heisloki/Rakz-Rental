@extends('layouts.customer')

@section('title', 'Rakz Rental - Vehicles')

@section('content')

    <div class="page-head">

        <div>

            <h1 class="page-title">
                Available Vehicles
            </h1>

            <p class="page-sub">
                Browse our vehicles and choose the one that suits your rental needs.
            </p>

        </div>

    </div>

    <x-alerts />


    {{-- SEARCH AND FILTER --}}

    <form
        method="GET"
        action="{{ route('vehicles.index') }}"
        class="toolbar"
    >

        <div class="field toolbar-search">

            <label for="search" class="label">
                Search Vehicles
            </label>

            <input
                type="text"
                id="search"
                name="search"
                class="input input-search"
                placeholder="Search by vehicle name, registration or category..."
                value="{{ request('search') }}"
            >

        </div>

        @if(isset($categories) && $categories->count() > 0)

            <div class="field toolbar-filter">

                <label for="category" class="label">
                    Category
                </label>

                <select id="category" name="category" class="select">

                    <option value="">
                        All Categories
                    </option>

                    @foreach($categories as $category)
                        <option
                            value="{{ $category }}"
                            {{ request('category') === $category ? 'selected' : '' }}
                        >
                            {{ $category }}
                        </option>
                    @endforeach

                </select>

            </div>

        @endif

        <button type="submit" class="btn btn-primary">
            Search
        </button>

        @if(request('search') || request('category'))

            <div class="toolbar-note">

                <span>
                    {{ $vehicles->count() }}
                    {{ $vehicles->count() === 1 ? 'vehicle' : 'vehicles' }} found
                </span>

                <a href="{{ route('vehicles.index') }}">
                    Clear Search
                </a>

            </div>

        @endif

    </form>


    {{-- VEHICLES --}}

    @if($vehicles->count() > 0)

        <div class="vehicle-grid">

            @foreach ($vehicles as $vehicle)

                <article class="card vehicle-card {{ $vehicle->status === 'available' ? '' : 'is-off' }}">

                    <div class="vehicle-card-top">

                        <span>{{ $vehicle->category }}</span>

                        @if($vehicle->status === 'available')
                            <x-badge tone="ok">Available</x-badge>
                        @else
                            <x-badge tone="off">Unavailable</x-badge>
                        @endif

                    </div>

                    <div class="vehicle-card-body">

                        <h2 class="vehicle-name">
                            {{ $vehicle->name }}
                        </h2>

                        <x-plate>{{ $vehicle->registration }}</x-plate>

                        <div class="vehicle-card-foot">

                            <span class="price">
                                ${{ number_format($vehicle->daily_rate, 2) }}
                                <span class="price-unit">/ day</span>
                            </span>

                            @if($vehicle->status === 'available')

                                <a
                                    href="{{ route('bookings.create', $vehicle) }}"
                                    class="btn btn-primary btn-block"
                                >
                                    Book Now
                                </a>

                            @else

                                <button class="btn btn-block" disabled>
                                    Currently Unavailable
                                </button>

                            @endif

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    @else

        <div class="empty">

            <h2>No vehicles found</h2>

            <p>Try changing your search.</p>

        </div>

    @endif

@endsection
