@extends('layouts.customer')

@section('title', 'Rakz Rental - Book Vehicle')

@section('content')

    <a href="{{ route('vehicles.index') }}" class="back-link">
        Back to Vehicles
    </a>

    <div class="page-head">

        <div>

            <h1 class="page-title">
                Book Your Vehicle
            </h1>

            <p class="page-sub">
                Select your rental dates to continue
            </p>

        </div>

    </div>

    <div class="flow">

        {{-- BOOKING FORM --}}

        <div class="card">

            <div class="card-body">

                <x-alerts error-title="Booking Unavailable" />

                <div class="note">

                    <div class="note-title">
                        Booking Information
                    </div>

                    Your selected dates will be checked before
                    the booking is confirmed. If the vehicle is
                    available, your booking will be confirmed
                    automatically.

                </div>

                <form
                    method="POST"
                    action="{{ route('bookings.store', $vehicle) }}"
                >

                    @csrf

                    <div class="field">

                        <label for="pickup_date" class="label">
                            Pickup Date
                        </label>

                        <input
                            type="date"
                            id="pickup_date"
                            name="pickup_date"
                            value="{{ old('pickup_date') }}"
                            min="{{ date('Y-m-d') }}"
                            class="input"
                            required
                        >

                    </div>

                    <div class="field">

                        <label for="return_date" class="label">
                            Return Date
                        </label>

                        <input
                            type="date"
                            id="return_date"
                            name="return_date"
                            value="{{ old('return_date') }}"
                            min="{{ date('Y-m-d') }}"
                            class="input"
                            required
                        >

                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Confirm Booking
                    </button>

                </form>

            </div>

        </div>


        {{-- SELECTED VEHICLE --}}

        <aside class="flow-aside">

            <div class="card">

                <div class="card-body">

                    <div class="small muted">
                        Selected Vehicle
                    </div>

                    <div class="summary-name">
                        {{ $vehicle->name }}
                    </div>

                    <div class="booking-meta">
                        <x-plate>{{ $vehicle->registration }}</x-plate>
                        <span>{{ $vehicle->category }}</span>
                    </div>

                    <div class="summary-row" style="margin-top: 18px;">

                        <span class="muted">Daily Rate</span>

                        <span class="price">
                            ${{ number_format($vehicle->daily_rate, 2) }}
                            <span class="price-unit">/ day</span>
                        </span>

                    </div>

                </div>

            </div>

        </aside>

    </div>

@endsection

@push('scripts')
    <script>

        const pickupDate = document.getElementById('pickup_date');
        const returnDate = document.getElementById('return_date');

        pickupDate.addEventListener('change', function () {
            returnDate.min = this.value;
        });

    </script>
@endpush
