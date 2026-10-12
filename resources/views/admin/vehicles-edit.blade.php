@extends('layouts.admin')

@section('title', 'Edit Vehicle - Rakz Rental')

@section('content')

    <div class="page-form">

        <a href="{{ route('admin.vehicles') }}" class="back-link">
            Back to Vehicles
        </a>

        <div class="page-head">

            <div>

                <h1 class="page-title">
                    Edit Vehicle
                </h1>

                <p class="page-sub">
                    Update the details of this rental vehicle.
                </p>

            </div>

        </div>

        <div class="card">

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Please correct the following errors:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.vehicles.update', $vehicle) }}">

                    @csrf
                    @method('PUT')

                    <div class="field">

                        <label for="registration" class="label">
                            Registration Number
                        </label>

                        <input
                            type="text"
                            id="registration"
                            name="registration"
                            class="input"
                            value="{{ old('registration', $vehicle->registration) }}"
                            required
                        >

                        @error('registration')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="field">

                        <label for="name" class="label">
                            Vehicle Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="input"
                            value="{{ old('name', $vehicle->name) }}"
                            required
                        >

                        @error('name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="field">

                        <label for="category" class="label">
                            Category
                        </label>

                        <select id="category" name="category" class="select" required>

                            <option value="Sedan" {{ old('category', $vehicle->category) == 'Sedan' ? 'selected' : '' }}>
                                Sedan
                            </option>

                            <option value="SUV" {{ old('category', $vehicle->category) == 'SUV' ? 'selected' : '' }}>
                                SUV
                            </option>

                            <option value="MPV" {{ old('category', $vehicle->category) == 'MPV' ? 'selected' : '' }}>
                                MPV
                            </option>

                            <option value="Van" {{ old('category', $vehicle->category) == 'Van' ? 'selected' : '' }}>
                                Van
                            </option>

                            <option value="Pickup" {{ old('category', $vehicle->category) == 'Pickup' ? 'selected' : '' }}>
                                Pickup
                            </option>

                            <option value="Hatchback" {{ old('category', $vehicle->category) == 'Hatchback' ? 'selected' : '' }}>
                                Hatchback
                            </option>

                            <option value="Wagon" {{ old('category', $vehicle->category) == 'Wagon' ? 'selected' : '' }}>
                                Wagon
                            </option>

                        </select>

                        @error('category')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="field">

                        <label for="daily_rate" class="label">
                            Daily Rental Rate ($)
                        </label>

                        <input
                            type="number"
                            id="daily_rate"
                            name="daily_rate"
                            class="input"
                            value="{{ old('daily_rate', $vehicle->daily_rate) }}"
                            min="0"
                            step="0.01"
                            required
                        >

                        @error('daily_rate')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="field">

                        <label for="status" class="label">
                            Status
                        </label>

                        <select id="status" name="status" class="select" required>

                            <option value="available" {{ old('status', $vehicle->status) == 'available' ? 'selected' : '' }}>
                                Available
                            </option>

                            <option value="unavailable" {{ old('status', $vehicle->status) == 'unavailable' ? 'selected' : '' }}>
                                Unavailable
                            </option>

                        </select>

                        @error('status')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary">
                            Update Vehicle
                        </button>

                        <a href="{{ route('admin.vehicles') }}" class="btn btn-secondary">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
