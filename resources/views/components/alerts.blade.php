{{--
    Flash messages and validation errors, in one place.
    Usage: <x-alerts />   or   <x-alerts error-title="Booking Unavailable" />
--}}
@props(['errorTitle' => null, 'validationTitle' => 'Please check the following:'])

@if(session('success'))
    <div class="alert alert-success" role="status">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" role="alert">
        @if($errorTitle)
            <strong>{{ $errorTitle }}</strong>
        @endif
        <div>{{ session('error') }}</div>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <strong>{{ $validationTitle }}</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
