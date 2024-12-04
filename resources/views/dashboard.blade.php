@extends('layouts.app')

@section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Personalizovaný text pro přihlášeného uživatele -->
                    <p class="text-lg mb-6">
                        @auth
                            {{ __("Welcome back, :name!", ['name' => auth()->user()->name]) }}
                        @else
                            {{ __("Welcome to the library!") }}
                        @endauth
                    </p>
                    <!-- Odkazy pro přihlášené uživatele -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <div class="bg-blue-500 p-4 rounded-lg shadow-lg text-white">
                            <h3 class="font-semibold text-xl mb-2">Prohlédnout knihy</h3>
                            <p>Browse the available books and make your selections.</p>
                            <a href="{{ route('books.index') }}" class="text-white underline mt-4 inline-block">Prohlédnout
                                knihy</a>
                        </div>

                        <div class="bg-green-500 p-4 rounded-lg shadow-lg text-white">
                            <h3 class="font-semibold text-xl mb-2">Rezervace</h3>
                            <p>Check your current and past reservations.</p>
                            <a href="{{ route('reservations.index') }}" class="text-white underline mt-4 inline-block">Zobrazit
                                rezervace</a>
                        </div>

                        @auth
                            <div class="bg-yellow-500 p-4 rounded-lg shadow-lg text-white">
                                <h3 class="font-semibold text-xl mb-2">Profil</h3>
                                <p>Update your personal information and settings.</p>
                                <a href="{{ route('profile.edit') }}" class="text-white underline mt-4 inline-block">Upravit
                                    profil</a>
                            </div>
                        @endauth
                    </div>

                    <!-- Statistika knihovny pro administrátora -->
                    @can('admin')
                        <div class="mt-8 bg-gray-100 p-6 rounded-lg shadow-lg">
                            <h3 class="font-semibold text-xl mb-4">Statistiky knihovny</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                <div class="bg-white p-4 rounded-lg shadow-md">
                                    <h4 class="font-medium text-lg text-gray-600">Celkový počet knih</h4>
                                    <p class="text-2xl font-semibold">{{ $totalBooks }}</p>
                                </div>

                                <div class="bg-white p-4 rounded-lg shadow-md">
                                    <h4 class="font-medium text-lg text-gray-600">Počet rezervací</h4>
                                    <p class="text-2xl font-semibold">{{ $totalReservations }}</p>
                                </div>

                                <div class="bg-white p-4 rounded-lg shadow-md">
                                    <h4 class="font-medium text-lg text-gray-600">Počet uživatelů</h4>
                                    <p class="text-2xl font-semibold">{{ $totalUsers }}</p>
                                </div>
                            </div>
                        </div>
                    @endcan

                </div>
            </div>
        </div>
    </div>
@endsection
