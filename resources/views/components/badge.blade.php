{{-- <x-badge tone="ok">Available</x-badge>   tone: ok | off | neutral --}}
@props(['tone' => 'neutral'])

<span {{ $attributes->merge(['class' => 'badge badge-' . $tone]) }}>{{ $slot }}</span>
