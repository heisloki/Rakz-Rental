{{-- <x-booking-status :status="$booking->status" /> --}}
@props(['status'])

@php
    $tone = match (strtolower((string) $status)) {
        'confirmed' => 'ok',
        'cancelled' => 'off',
        default => 'neutral',
    };
@endphp

<x-badge :tone="$tone">{{ ucfirst($status) }}</x-badge>
