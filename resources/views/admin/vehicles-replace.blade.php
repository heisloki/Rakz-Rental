@extends('layouts.admin')

@section('title', 'Replace Vehicle - Rakz Rental')

@section('content')

    <div class="page-form">

        <a href="{{ route('admin.vehicles') }}" class="back-link">
            Back to Vehicles
        </a>

        <div class="page-head">

            <div>

                <h1 class="page-title">
                    Replace Vehicle
                </h1>

                <p class="page-sub">
                    Add a replacement vehicle to the fleet.
                </p>

            </div>

        </div>

        <div class="card">

            <div class="card-body">

                <div class="replacement" style="margin-bottom: 20px;">

                    <div class="replacement-title">
                        Vehicle Being Replaced
                    </div>

                    <div style="font-size: 18px; font-weight: 650;">
                        {{ $vehicle->name }}
                    </div>

                    <p>
                        Registration:
                        <strong>{{ $vehicle->registration }}</strong>
                    </p>

                    <p>
                        Category:
                        <strong>{{ $vehicle->category }}</strong>
                    </p>

                </div>

                <div class="note">

                    <strong>Important:</strong>

                    The current vehicle will be marked as
                    unavailable. Its existing booking history
                    will be preserved. The replacement vehicle
                    will be added to the fleet as available.

                </div>

                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Please check the following:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    method="POST"
                    action="{{ route('admin.vehicles.replace', $vehicle) }}"
                >

                    @csrf

                    <div class="field">

                        <label for="registration" class="label">
                            Replacement Registration
                        </label>

                        <input
                            type="text"
                            id="registration"
                            name="registration"
                            class="input"
                            value="{{ old('registration') }}"
                            placeholder="Example: LR6000"
                            required
                        >

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
                            value="{{ old('name') }}"
                            placeholder="Example: Toyota Corolla"
                            required
                        >

                    </div>

                    <div class="field">

                        <label for="category" class="label">
                            Category
                        </label>

                        <select id="category" name="category" class="select" required>

                            <option value="">
                                Select Category
                            </option>

                            <option value="Sedan" {{ old('category') == 'Sedan' ? 'selected' : '' }}>
                                Sedan
                            </option>

                            <option value="SUV" {{ old('category') == 'SUV' ? 'selected' : '' }}>
                                SUV
                            </option>

                            <option value="Van" {{ old('category') == 'Van' ? 'selected' : '' }}>
                                Van
                            </option>

                            <option value="MPV" {{ old('category') == 'MPV' ? 'selected' : '' }}>
                                MPV
                            </option>

                            <option value="Pickup" {{ old('category') == 'Pickup' ? 'selected' : '' }}>
                                Pickup
                            </option>

                            <option value="Hatchback" {{ old('category') == 'Hatchback' ? 'selected' : '' }}>
                                Hatchback
                            </option>

                            <option value="Wagon" {{ old('category') == 'Wagon' ? 'selected' : '' }}>
                                Wagon
                            </option>

                        </select>

                    </div>

                    <div class="field">

                        <label for="daily_rate" class="label">
                            Daily Rate
                        </label>

                        <input
                            type="number"
                            id="daily_rate"
                            name="daily_rate"
                            class="input"
                            value="{{ old('daily_rate') }}"
                            placeholder="Example: 150"
                            min="0"
                            step="0.01"
                            required
                        >

                    </div>

                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary">
                            Replace Vehicle
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
