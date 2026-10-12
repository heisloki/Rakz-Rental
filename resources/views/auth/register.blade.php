<<<<<<< Updated upstream
@extends('layouts.app')
@section('title', 'Register')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="rz-card p-8">
        <h1 class="text-2xl font-bold mb-1">Create your account</h1>
        <p class="text-sm text-gray-400 mb-6">Register as a customer to start booking vehicles.</p>

        <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @csrf
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-300 block mb-1">Full name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="rz-input w-full rounded-md px-3 py-2" data-testid="register-name">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-300 block mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="rz-input w-full rounded-md px-3 py-2" data-testid="register-email">
            </div>
            <div>
                <label class="text-sm text-gray-300 block mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="rz-input w-full rounded-md px-3 py-2" data-testid="register-phone">
            </div>

            <div class="sm:col-span-2">
                <label class="text-sm text-gray-300 block mb-1">Address</label>
                <input type="text" name="address" value="{{ old('address') }}" class="rz-input w-full rounded-md px-3 py-2" data-testid="register-address">
            </div>
            <div>
                <label class="text-sm text-gray-300 block mb-1">Driver license</label>
                <input type="text" name="driver_license" value="{{ old('driver_license') }}" class="rz-input w-full rounded-md px-3 py-2" data-testid="register-license">
            </div>
            <div></div>
            <div>
                <label class="text-sm text-gray-300 block mb-1">Password</label>
                <input type="password" name="password" required class="rz-input w-full rounded-md px-3 py-2" data-testid="register-password">
            </div>
            <div>
                <label class="text-sm text-gray-300 block mb-1">Confirm password</label>
                <input type="password" name="password_confirmation" required class="rz-input w-full rounded-md px-3 py-2" data-testid="register-password-confirmation">
            </div>

            <div class="sm:col-span-2">
                <button type="submit" class="rz-btn w-full rounded-md py-2.5" data-testid="register-submit">
                    Create account <i class="fa-solid fa-arrow-right ml-1"></i>
                </button>
            </div>
        </form>

        <p class="text-sm text-gray-400 mt-6 text-center">
            Already have an account? <a href="{{ route('login') }}" class="rz-primary font-medium" data-testid="link-login">Log in</a>
        </p>
    </div>
</div>
=======
@extends('layouts.auth')

@section('title', 'Rakz Rental - Sign Up')

@section('content')

    <h1>Create your customer account</h1>

    <x-alerts />

    <form method="POST" action="{{ route('register.submit') }}">

        @csrf

        <div class="field">

            <label for="name" class="label">
                Full Name
            </label>

            <input
                type="text"
                id="name"
                name="name"
                class="input"
                value="{{ old('name') }}"
                placeholder="Enter your full name"
                required
            >

        </div>

        <div class="field">

            <label for="email" class="label">
                Email Address
            </label>

            <input
                type="email"
                id="email"
                name="email"
                class="input"
                value="{{ old('email') }}"
                placeholder="Enter your email address"
                required
            >

        </div>

        <div class="field" style="margin-bottom: 8px;">

            <label for="password" class="label">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                class="input"
                placeholder="Create a strong password"
                required
            >

        </div>

        <div class="help-box">

            <div class="help-box-title">
                Password must contain:
            </div>

            <ul>
                <li>At least 8 characters</li>
                <li>At least one uppercase letter</li>
                <li>At least one lowercase letter</li>
                <li>At least one number</li>
                <li>At least one special character</li>
            </ul>

        </div>

        <div class="field">

            <label for="password_confirmation" class="label">
                Confirm Password
            </label>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="input"
                placeholder="Confirm your password"
                required
            >

        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Create Account
        </button>

    </form>

    <p class="auth-switch">
        Already have an account?
        <a href="{{ route('login') }}">
            Login
        </a>
    </p>

>>>>>>> Stashed changes
@endsection
