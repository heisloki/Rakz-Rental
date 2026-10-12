@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.customer')

@section('title', 'My Profile - Rakz Rental')

@section('content')

    <div class="page-narrow">

        <div class="page-head">

            <div>
                <h1 class="page-title">
                    My Profile
                </h1>
            </div>

        </div>

        <x-alerts />

        <div class="card">

            <div class="card-body">

                <div class="profile-head">

                    <div class="avatar" aria-hidden="true">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>

                        <h2 class="profile-name">
                            {{ auth()->user()->name }}
                        </h2>

                        <p class="muted">
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                </div>

                <div class="info-list">

                    <div class="info-row">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">{{ auth()->user()->name }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Email Address</div>
                        <div class="info-value">{{ auth()->user()->email }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Account Type</div>
                        <div class="info-value">
                            @if(auth()->user()->role === 'admin')
                                Administrator
                            @else
                                Customer
                            @endif
                        </div>
                    </div>

                </div>

                <div class="profile-actions">

                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                        Edit Profile
                    </a>

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to logout?');"
                    >
                        @csrf
                        <button type="submit" class="btn btn-secondary">
                            Logout
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
