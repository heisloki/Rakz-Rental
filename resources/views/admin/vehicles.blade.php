@extends('layouts.admin')

@section('title', 'Vehicles - Rakz Rental')

@section('content')

    <div class="page-head">

        <div>

            <h1 class="page-title">
                Vehicles
            </h1>

            <p class="page-sub">
                Manage the vehicles available for rental.
            </p>

        </div>

        <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary">
            Add Vehicle
        </a>

    </div>

    <x-alerts />

    <section class="card">

        <div class="card-body">

            <h2 class="section-title" style="margin-bottom: 18px;">
                Vehicle Fleet
            </h2>

            @if($vehicles->count() > 0)

                <div class="table-wrap">

                    <table class="table">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Registration</th>
                                <th>Vehicle</th>
                                <th>Category</th>
                                <th class="col-num">Daily Rate</th>
                                <th>Status</th>
                                <th class="col-actions">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($vehicles as $vehicle)

                                <tr>

                                    <td class="muted">{{ $loop->iteration }}</td>

                                    <td>
                                        <x-plate>{{ $vehicle->registration }}</x-plate>
                                    </td>

                                    <td>

                                        {{ $vehicle->name }}

                                        @if($vehicle->bookings()->exists())
                                            <span class="table-note">
                                                Has booking history
                                            </span>
                                        @endif

                                    </td>

                                    <td>{{ $vehicle->category }}</td>

                                    <td class="col-num">${{ number_format($vehicle->daily_rate, 2) }}</td>

                                    <td>

                                        @if($vehicle->status === 'available')
                                            <x-badge tone="ok">Available</x-badge>
                                        @else
                                            <x-badge tone="off">Unavailable</x-badge>
                                        @endif

                                    </td>

                                    <td class="col-actions">

                                        <a
                                            href="{{ route('admin.vehicles.edit', $vehicle) }}"
                                            class="btn btn-secondary btn-sm"
                                        >
                                            Edit
                                        </a>

                                        <a
                                            href="{{ route('admin.vehicles.replacement', $vehicle) }}"
                                            class="btn btn-secondary btn-sm"
                                        >
                                            Replace
                                        </a>

                                        <form
                                            action="{{ route('admin.vehicles.destroy', $vehicle) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to retire this vehicle? The vehicle record and booking history will be preserved.');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Retire
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty">

                    <h3>No vehicles found</h3>

                    <p>Add a vehicle to your fleet to get started.</p>

                </div>

            @endif

        </div>

    </section>

@endsection
