@props(['user'])

@php
    $roleClass = match($user->role) {
        'moderator' => 'text-yellow-400 drop-shadow-[0_0_8px_rgba(255,217,0,0.7)] hover:text-yellow-300 hover:drop-shadow-[0_0_10px_rgba(255,217,0,0.9)] transition-all duration-300',
        'admin' => 'text-red-600 font-bold drop-shadow-[0_0_10px_rgba(220,38,38,0.8)] hover:text-red-500 hover:drop-shadow-[0_0_12px_rgba(220,38,38,1)] transition-all duration-300',
        default => 'text-gray-500 drop-shadow-[0_0_6px_rgba(107,114,128,0.5)] hover:text-gray-400 hover:drop-shadow-[0_0_8px_rgba(107,114,128,0.7)] transition-all duration-300'
    };
@endphp

<a href="{{ route('profile', $user->username) }}" {{ $attributes->merge(['class' => "font-semibold cursor-pointer {$roleClass}"]) }}>
    {{ $user->username }}
</a>