@extends('layouts.admin')
<<<<<<< Updated upstream
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Overview of fleet activity, bookings, revenue and replacements')

@section('content')
<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['label'=>'Total Vehicles','value'=>$stats['total_vehicles'],'icon'=>'fa-car','color'=>'text-sky-300'],
        ['label'=>'Available','value'=>$stats['available_vehicles'],'icon'=>'fa-circle-check','color'=>'text-emerald-300'],
        ['label'=>'Maintenance','value'=>$stats['maintenance_vehicles'],'icon'=>'fa-wrench','color'=>'text-amber-300'],
        ['label'=>'Customers','value'=>$stats['total_customers'],'icon'=>'fa-users','color'=>'text-violet-300'],
    ] as $s)
        <div class="rz-card p-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center {{ $s['color'] }}">
                    <i class="fa-solid {{ $s['icon'] }}"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-400">{{ $s['label'] }}</div>
                    <div class="text-2xl font-bold">{{ $s['value'] }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['label'=>'Total Bookings','value'=>$stats['total_bookings'],'icon'=>'fa-calendar','color'=>'text-sky-300'],
        ['label'=>'Pending','value'=>$stats['pending_bookings'],'icon'=>'fa-hourglass','color'=>'text-amber-300'],
        ['label'=>'Confirmed','value'=>$stats['confirmed_bookings'],'icon'=>'fa-check','color'=>'text-emerald-300'],
        ['label'=>'Replacements','value'=>$stats['total_replacements'],'icon'=>'fa-shuffle','color'=>'rz-primary'],
    ] as $s)
        <div class="rz-card p-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center {{ $s['color'] }}">
                    <i class="fa-solid {{ $s['icon'] }}"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-400">{{ $s['label'] }}</div>
                    <div class="text-2xl font-bold">{{ $s['value'] }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="rz-card p-5 mb-6">
    <div class="text-xs text-gray-400">Total revenue (confirmed + completed)</div>
    <div class="text-3xl font-bold rz-primary">FJD {{ number_format($stats['revenue'], 2) }}</div>
</div>

<!-- Recent -->
<div class="rz-card p-5">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold">Recent bookings</h2>
        <a href="{{ route('admin.bookings.index') }}" class="text-sm rz-primary">View all →</a>
    </div>
    @if($recentBookings->isEmpty())
        <p class="text-sm text-gray-400">No bookings yet.</p>
    @else
        <table class="w-full rz-table text-sm">
            <thead><tr>
                <th class="text-left">#</th><th class="text-left">Customer</th><th class="text-left">Vehicle</th>
                <th class="text-left">Dates</th><th class="text-left">Total</th><th class="text-left">Status</th>
            </tr></thead>
            <tbody>
                @foreach($recentBookings as $b)
                    <tr class="hover:bg-white/5">
                        <td><a href="{{ route('admin.bookings.show', $b) }}" class="rz-primary">#{{ $b->id }}</a></td>
                        <td>{{ $b->user->name }}</td>
                        <td><span class="font-mono text-xs">{{ $b->vehicle_registration_no }}</span><br><span class="text-xs text-gray-400">{{ $b->vehicle?->name }}</span></td>
                        <td class="text-xs">{{ $b->pickup_date->format('M d') }} → {{ $b->return_date->format('M d') }}</td>
                        <td>FJD {{ number_format($b->total_amount, 0) }}</td>
                        <td><span class="rz-badge bg-white/5">{{ ucfirst($b->status) }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
=======

@section('title', 'Rakz Rental - Admin Dashboard')

@push('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')

    <div class="page-head">

        <div>

            <h1 class="page-title">
                Admin Dashboard
            </h1>

            <p class="page-sub">
                Welcome back, {{ auth()->user()->name }}.
                Here's an overview of Rakz Rental.
            </p>

        </div>

    </div>


    {{-- STATISTICS --}}

    <div class="stat-panels">
        
        <section class="card stat-panel" aria-labelledby="bookings-stats">

            <h2 id="bookings-stats">Bookings</h2>

            <div class="stat-grid">

                <div>
                    <div class="stat-number">{{ $totalBookings }}</div>
                    <div class="stat-label">Total Bookings</div>
                    <div class="stat-caption">All rental bookings</div>
                </div>

                <div>
                    <div class="stat-number">{{ $confirmedBookings }}</div>
                    <div class="stat-label">Confirmed</div>
                    <div class="stat-caption">Confirmed rentals</div>
                </div>

                <div>
                    <div class="stat-number">{{ $cancelledBookings }}</div>
                    <div class="stat-label">Cancelled</div>
                    <div class="stat-caption">Cancelled rentals</div>
                </div>

            </div>

        </section>

        <section class="card stat-panel" aria-labelledby="fleet-stats">

            <h2 id="fleet-stats">Fleet</h2>

            <div class="stat-grid">

                <div>
                    <div class="stat-number">{{ $totalVehicles }}</div>
                    <div class="stat-label">Total Vehicles</div>
                    <div class="stat-caption">Vehicles in the system</div>
                </div>

                <div>
                    <div class="stat-number">{{ $availableVehicles }}</div>
                    <div class="stat-label">Available Vehicles</div>
                    <div class="stat-caption">Ready for rental</div>
                </div>

                <div>
                    <div class="stat-number">{{ $unavailableVehicles }}</div>
                    <div class="stat-label">Unavailable Vehicles</div>
                    <div class="stat-caption">Maintenance or unavailable</div>
                </div>

            </div>

        </section>

    </div>


    {{-- ANALYTICS --}}

    <div class="split">

        <section class="card">

            <div class="card-body">

                <h2 class="section-title">
                    Booking Analytics
                </h2>

                <p class="section-sub">
                    Overview of booking statuses
                </p>

                <div class="chart-box">
                    <canvas id="bookingChart"></canvas>
                </div>

            </div>

        </section>

        <section class="card">

            <div class="card-body">

                <h2 class="section-title">
                    Booking Summary
                </h2>

                <p class="section-sub" style="margin-bottom: 20px;">
                    Current booking status
                </p>

                <div class="summary-box">
                    <div class="summary-label">Confirmed Bookings</div>
                    <div class="summary-number">{{ $confirmedBookings }}</div>
                </div>

                <div class="summary-box">
                    <div class="summary-label">Cancelled Bookings</div>
                    <div class="summary-number">{{ $cancelledBookings }}</div>
                </div>

            </div>

        </section>

    </div>


    {{-- RECENT BOOKINGS --}}

    <section class="card">

        <div class="card-body">

            <div class="panel-head">

                <div>

                    <h2 class="section-title">
                        Recent Bookings
                    </h2>

                    <p class="section-sub">
                        Latest vehicle rental bookings.
                    </p>

                </div>

                <a href="{{ route('admin.bookings') }}" class="btn btn-secondary btn-sm">
                    View All
                </a>

            </div>

            @if($recentBookings->count() > 0)

                <div class="table-wrap">

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Vehicle</th>
                                <th>Pickup</th>
                                <th>Return</th>
                                <th class="col-num">Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($recentBookings as $booking)

                                <tr>

                                    <td>{{ $booking->customer_name }}</td>

                                    <td>{{ $booking->vehicle->name }}</td>

                                    <td>{{ \Carbon\Carbon::parse($booking->pickup_date)->format('d M Y') }}</td>

                                    <td>{{ \Carbon\Carbon::parse($booking->return_date)->format('d M Y') }}</td>

                                    <td class="col-num">${{ number_format($booking->total_amount, 2) }}</td>

                                    <td>
                                        <x-booking-status :status="$booking->status" />
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty">

                    <h3>No bookings yet</h3>

                    <p>New bookings will appear here.</p>

                </div>

            @endif

        </div>

    </section>

@endsection

@push('scripts')
    <script>

        const bookingChartData = @json($bookingChart);

        const ctx = document
            .getElementById('bookingChart')
            .getContext('2d');

        Chart.defaults.font.family = '"Public Sans", system-ui, sans-serif';
        Chart.defaults.color = '#4A6274';

        // Wait for the web font so the chart text matches the rest of the page
        document.fonts.ready.then(function () {

        new Chart(ctx, {

            type: 'doughnut',

            data: {

                labels: [
                    'Confirmed',
                    'Cancelled'
                ],

                datasets: [{

                    data: [
                        bookingChartData.confirmed,
                        bookingChartData.cancelled
                    ],

                    backgroundColor: [
                        '#005691',
                        '#9DBBD0'
                    ],

                    borderColor: '#FFFFFF',

                    borderWidth: 2

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                cutout: '62%',

                plugins: {

                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, boxWidth: 8, padding: 18 }
                    }

                }

            }

        });

        });

    </script>
@endpush
>>>>>>> Stashed changes
