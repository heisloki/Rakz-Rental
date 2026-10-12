@extends('layouts.admin')

@section('title', 'Replace Vehicle - Rakz Rental')

@section('content')

    <a href="{{ route('admin.bookings') }}" class="back-link">
        Back to Bookings
    </a>

    <div class="page-head">

        <div>

            <h1 class="page-title">
                Replace Vehicle
            </h1>

            <p class="page-sub">
                Select another available vehicle for this customer's confirmed booking.
            </p>

        </div>

    </div>

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="stack">

        <section class="card">

            <div class="card-body">

                <h2 class="section-title" style="margin-bottom: 20px;">
                    Booking Information
                </h2>

                <dl class="facts facts-3">

                    <div>
                        <dt>Booking ID</dt>
                        <dd>#{{ $booking->id }}</dd>
                    </div>

                    <div>
                        <dt>Customer</dt>
                        <dd>{{ $booking->user->name ?? $booking->customer_name }}</dd>
                    </div>

                    <div>
                        <dt>Current Vehicle</dt>
                        <dd>
                            {{ $booking->vehicle->registration ?? 'N/A' }}
                            -
                            {{ $booking->vehicle->name ?? 'N/A' }}
                        </dd>
                    </div>

                    <div>
                        <dt>Pickup Date</dt>
                        <dd>{{ \Carbon\Carbon::parse($booking->pickup_date)->format('d M Y') }}</dd>
                    </div>

                    <div>
                        <dt>Return Date</dt>
                        <dd>{{ \Carbon\Carbon::parse($booking->return_date)->format('d M Y') }}</dd>
                    </div>

                    <div>
                        <dt>Booking Status</dt>
                        <dd>{{ ucfirst($booking->status) }}</dd>
                    </div>

                </dl>

            </div>

        </section>


        <section class="card">

            <div class="card-body">

                <h2 class="section-title" style="margin-bottom: 20px;">
                    Available Replacement Vehicles
                </h2>

                @if($replacementVehicles->count() > 0)

                    <form
                        method="POST"
                        action="{{ route('admin.bookings.replace', $booking) }}"
                    >

                        @csrf

                        <div class="choice-grid">

                            @foreach($replacementVehicles as $vehicle)

                                <div class="choice">

                                    <input
                                        type="radio"
                                        id="vehicle-{{ $vehicle->id }}"
                                        name="replacement_vehicle_id"
                                        value="{{ $vehicle->id }}"
                                        required
                                    >

                                    <label for="vehicle-{{ $vehicle->id }}" class="choice-card">

                                        <x-plate>{{ $vehicle->registration }}</x-plate>

                                        <span class="choice-name">
                                            {{ $vehicle->name }}
                                        </span>

                                        <span class="choice-meta">
                                            {{ $vehicle->category }}, Available
                                        </span>

                                        <span class="choice-price">
                                            ${{ number_format($vehicle->daily_rate, 2) }}/day
                                        </span>

                                        <span class="choice-state choice-state-off">
                                            Select this vehicle
                                        </span>

                                        <span class="choice-state choice-state-on">
                                            Selected
                                        </span>

                                    </label>

                                </div>

                            @endforeach

                        </div>

                        <div class="form-actions">

                            <button
                                type="submit"
                                class="btn btn-primary"
                                onclick="return confirm('Are you sure you want to replace the vehicle for this booking?')"
                            >
                                Replace Vehicle
                            </button>

                            <a href="{{ route('admin.bookings') }}" class="btn btn-secondary">
                                Cancel
                            </a>

                        </div>

                    </form>

                @else

                    <div class="empty">

                        <h3>No Replacement Vehicles Available</h3>

                        <p>
                            There are currently no available vehicles that can replace
                            the current vehicle for these booking dates.
                        </p>

                    </div>

                @endif

            </div>

        </section>

    </div>

@endsection
