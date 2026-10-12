@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.customer')

@section('title', 'Rakz Rental - Edit Profile')

@section('content')

    <div class="page-form">

        <a href="{{ route('profile.show') }}" class="back-link">
            Back to Profile
        </a>

        <div class="page-head">

            <div>

                <h1 class="page-title">
                    Edit Profile
                </h1>

                <p class="page-sub">
                    Update your Rakz Rental account information.
                </p>

            </div>

        </div>

        <div class="card">

            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">

                    @csrf
                    @method('PUT')

                    <div class="field">

                        <label for="name" class="label">
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="input"
                            value="{{ old('name', auth()->user()->name) }}"
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
                            value="{{ old('email', auth()->user()->email) }}"
                            required
                        >

                    </div>


                    <div class="form-section">

                        <h2>Security Verification</h2>

                        <p>
                            Enter your current password to save changes to your profile.
                        </p>

                        <div class="field field-last">

                            <label for="current_password" class="label">
                                Current Password
                            </label>

                            <input
                                type="password"
                                id="current_password"
                                name="current_password"
                                class="input"
                                required
                            >

                            @error('current_password')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    <div class="form-section">

                        <h2>Change Password</h2>

                        <p>
                            Leave these fields empty if you do not want to change your password.
                        </p>

                        <div class="field">

                            <label for="password" class="label">
                                New Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="input"
                            >

                        </div>

                        <div class="field field-last">

                            <label for="password_confirmation" class="label">
                                Confirm New Password
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="input"
                            >

                        </div>

                    </div>


                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>

                        <a href="{{ route('profile.show') }}" class="btn btn-secondary">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
