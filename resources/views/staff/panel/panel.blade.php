@extends('layouts.app')

@section('title', 'Админ-панель')

@push('links')
    @vite('resources/js/staff/user-statistics.js')
@endpush

@section('content')

<div class="bg-gray-900 text-gray-100 rounded-lg">

    <!-- Основной контент -->
    <main class="min-h-screen p-6">
        <div class="p-4 lg:pt-6">
            <!-- Приветствие -->
            <div class="p-6 bg-gray-900 rounded-lg shadow-md border border-gray-700">
                <h2 class="text-2xl font-bold mb-2">
                    Здравствуйте, <span class="">{{ auth()->user()->username }}</span>!
                </h2>
                <p class="text-gray-400">Управляйте вашим форумом с помощью удобной панели администратора</p>
            </div>

            <x-staff.actions />

            <x-staff.user-statistics />

        </div>
    </main>

    
</div>
@endsection


