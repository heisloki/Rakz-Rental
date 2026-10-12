@extends('layouts.customer')

@section('title', 'Rakz Rental - Booking History')

@section('content')

    <div class="page-head">

        <div>

            <h1 class="page-title">
                My Booking History
            </h1>

            <p class="page-sub">
                View and track your vehicle rental bookings.
            </p>

        </div>

    </div>

    <x-alerts />


    {{-- NOTIFICATIONS --}}

    @if(isset($notifications) && $notifications->count() > 0)

        <section aria-labelledby="notifications-title">

            <h2 id="notifications-title" class="section-title" style="margin-bottom: 12px;">
                Notifications
            </h2>

            <div class="notice-list">

                @foreach($notifications as $notification)

                    <div class="notice">

                        <div class="notice-title">
                            {{ $notification->title }}
                        </div>

                        <div class="notice-message">
                            {{ $notification->message }}
                        </div>

                        <div class="notice-date">
                            {{ $notification->created_at->format('d M Y, h:i A') }}
                        </div>

                    </div>

                @endforeach

            </div>

        </section>

    @endif


    {{-- BOOKINGS --}}

    @if($bookings->count() > 0)

        <div class="booking-list">

            @foreach($bookings as $booking)

                <article class="card">

                    <div class="card-body">

                        <div class="booking-card-head">

                            <div>

                                <div class="booking-vehicle">
                                    @if($booking->replacementVehicle)
                                        {{ $booking->replacementVehicle->name }}
                                    @else
                                        {{ $booking->vehicle->name }}
                                    @endif
                                </div>

                                <div class="booking-meta">

                                    @if($booking->replacementVehicle)
                                        <x-plate>{{ $booking->replacementVehicle->registration }}</x-plate>
                                        <span>{{ $booking->replacementVehicle->category }}</span>
                                    @else
                                        <x-plate>{{ $booking->vehicle->registration }}</x-plate>
                                        <span>{{ $booking->vehicle->category }}</span>
                                    @endif

                                </div>

                            </div>

                            @if($booking->status === 'confirmed')
                                <x-badge tone="ok">Confirmed</x-badge>
                            @elseif($booking->status === 'cancelled')
                                <x-badge tone="off">Cancelled</x-badge>
                            @endif

                        </div>


                        @if($booking->replacementVehicle)

                            <div class="replacement">

                                <div class="replacement-title">
                                    Vehicle Replaced
                                </div>

                                <p>
                                    Original Vehicle:
                                    {{ $booking->vehicle->registration }}
                                    -
                                    {{ $booking->vehicle->name }}
                                </p>

                                <p>
                                    New Vehicle:
                                    {{ $booking->replacementVehicle->registration }}
                                    -
                                    {{ $booking->replacementVehicle->name }}
                                </p>

                                <p class="replacement-note">
                                    Your booking dates and total amount remain unchanged.
                                </p>

                            </div>

                        @endif


                        <dl class="facts">

                            <div>
                                <dt>Pickup Date</dt>
                                <dd>{{ \Carbon\Carbon::parse($booking->pickup_date)->format('d M Y') }}</dd>
                            </div>

                            <div>
                                <dt>Return Date</dt>
                                <dd>{{ \Carbon\Carbon::parse($booking->return_date)->format('d M Y') }}</dd>
                            </div>

                            <div>
                                <dt>Rental Days</dt>
                                <dd>
                                    {{ \Carbon\Carbon::parse($booking->pickup_date)->diffInDays(\Carbon\Carbon::parse($booking->return_date)) }}
                                    day(s)
                                </dd>
                            </div>

                            <div>
                                <dt>Total Amount</dt>
                                <dd class="num">${{ number_format($booking->total_amount, 2) }}</dd>
                            </div>

                        </dl>


                        <div class="booking-card-foot">

                            <span class="muted small">
                                Booking created:
                                {{ $booking->created_at->format('d M Y') }}
                            </span>

                            @if($booking->status === 'confirmed')

                                <form
                                    action="{{ route('bookings.cancel', $booking) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to cancel this booking?');"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Cancel Booking
                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    @else

        <div class="empty">

            <h2>No Bookings Yet</h2>

            <p>You haven't made any vehicle bookings yet.</p>

            <a href="{{ route('vehicles.index') }}" class="btn btn-primary">
                Browse Vehicles
            </a>

        </div>

    @endif

@endsection
