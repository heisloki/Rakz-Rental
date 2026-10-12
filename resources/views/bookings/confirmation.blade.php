@extends('layouts.customer')

@section('title', 'Rakz Rental - Booking Confirmed')

@section('page_class', 'page-narrow')

@section('content')

    <div class="card">

        <div class="card-body">

            <div class="confirm-head">

                <div class="confirm-mark" aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12.5l4.5 4.5L19 7.5"/>
                    </svg>
                </div>

                <h1 class="confirm-title">
                    Booking Confirmed
                </h1>

                <p class="page-sub" style="margin-inline: auto;">
                    Your vehicle has been successfully reserved.
                </p>

            </div>


            <div class="reference">

                <div class="reference-label">
                    Booking Reference
                </div>

                <div class="reference-number">
                    #{{ $booking->id }}
                </div>

            </div>


            <h2 class="vehicle-name">
                {{ $booking->vehicle->name }}
            </h2>

            <div class="booking-meta" style="margin-bottom: 24px;">
                <span>{{ $booking->vehicle->category }}</span>
                <span>
                    Daily Rate:
                    <strong>${{ number_format($booking->vehicle->daily_rate, 2) }}</strong>
                </span>
            </div>


            <dl class="facts facts-2">

                <div>
                    <dt>Customer</dt>
                    <dd>{{ $booking->customer_name }}</dd>
                </div>

                <div>
                    <dt>Vehicle Registration</dt>
                    <dd>{{ $booking->vehicle->registration }}</dd>
                </div>

                <div>
                    <dt>Pickup Date</dt>
                    <dd>{{ \Carbon\Carbon::parse($booking->pickup_date)->format('d M Y') }}</dd>
                </div>

                <div>
                    <dt>Return Date</dt>
                    <dd>{{ \Carbon\Carbon::parse($booking->return_date)->format('d M Y') }}</dd>
                </div>

            </dl>


            <div class="total-row">

                <div>

                    <div class="total-label">
                        Total Rental Cost
                    </div>

                    <div class="total-value">
                        ${{ number_format($booking->total_amount, 2) }}
                    </div>

                </div>

                <x-booking-status :status="$booking->status" />

            </div>


            <div class="center-actions">

                <a href="{{ route('vehicles.index') }}" class="btn btn-primary">
                    Browse Vehicles
                </a>

                <a href="{{ route('bookings.index') }}" class="btn btn-secondary">
                    Booking History
                </a>

            </div>

            <p class="muted small" style="text-align: center; margin-top: 24px;">
                Thank you for choosing Rakz Rental.
                Your booking details have been recorded.
            </p>

        </div>

    </div>

@endsection
