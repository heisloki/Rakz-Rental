@extends('layouts.admin')

@section('title', 'Rakz Rental - Manage Bookings')

@section('content')

    <div class="page-head">

        <div>

            <h1 class="page-title">
                Manage Bookings
            </h1>

            <p class="page-sub">
                Review and manage customer rental bookings.
            </p>

        </div>

    </div>

    <x-alerts />

    @if($bookings->count() > 0)

        <div class="booking-list">

            @foreach($bookings as $booking)

                <article class="card">

                    <div class="card-body">

                        <div class="booking-card-head">

                            <div>

                                <div class="booking-vehicle">
                                    {{ $booking->vehicle->name }}
                                </div>

                                <div class="booking-meta">
                                    <x-plate>{{ $booking->vehicle->registration }}</x-plate>
                                    <span>{{ $booking->vehicle->category }}</span>
                                </div>

                            </div>

                            @if($booking->status === 'confirmed')
                                <x-badge tone="ok">Confirmed</x-badge>
                            @else
                                <x-badge tone="off">Cancelled</x-badge>
                            @endif

                        </div>


                        <dl class="facts">

                            <div>
                                <dt>Customer</dt>
                                <dd>{{ $booking->customer_name }}</dd>
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
                                <dt>Total</dt>
                                <dd class="num">${{ number_format($booking->total_amount, 2) }}</dd>
                            </div>

                        </dl>


                        @if($booking->replacement_vehicle_id && $booking->replacementVehicle)

                            <div class="replacement" style="margin: 22px 0 0;">

                                <div class="replacement-title">
                                    Replacement Vehicle
                                </div>

                                <div class="booking-meta" style="margin-top: 4px;">
                                    <x-plate>{{ $booking->replacementVehicle->registration }}</x-plate>
                                    <strong style="color: var(--ink);">{{ $booking->replacementVehicle->name }}</strong>
                                    <span>{{ $booking->replacementVehicle->category }}</span>
                                    <span>${{ number_format($booking->replacementVehicle->daily_rate, 2) }}/day</span>
                                </div>

                            </div>

                        @endif


                        @if($booking->status === 'confirmed')

                            <div class="booking-card-foot" style="justify-content: flex-start;">

                                <a
                                    href="{{ route('admin.bookings.replacement', $booking) }}"
                                    class="btn btn-secondary btn-sm"
                                >
                                    Replace Vehicle
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.bookings.status', $booking) }}"
                                    onsubmit="return confirm('Are you sure you want to cancel this booking?');"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <input
                                        type="hidden"
                                        name="status"
                                        value="cancelled"
                                    >

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Cancel Booking
                                    </button>

                                </form>

                            </div>

                        @endif

                    </div>

                </article>

            @endforeach

        </div>

    @else

        <div class="empty">

            <h2>No Bookings</h2>

            <p>There are currently no customer bookings.</p>

        </div>

    @endif

@endsection
