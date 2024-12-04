<!-- resources/views/profile/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Zobrazí formulář pro úpravu profilu -->
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full p-2 border rounded-md dark:bg-zinc-800 dark:text-white" required autofocus>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full p-2 border rounded-md dark:bg-zinc-800 dark:text-white" required>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Save</button>
                        </div>
                    </form>

                    <!-- Možnost smazání účtu -->
                    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()
