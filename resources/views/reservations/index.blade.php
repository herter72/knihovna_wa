<!-- resources/views/reservations/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Moje rezervace</h1>

        @if($reservations->isEmpty())
            <p class="text-gray-400">Nemáte žádné aktivní rezervace.</p>
        @else
            <div class="space-y-4">
                @foreach($reservations as $reservation)
                    <div class="bg-gray-800 text-white p-4 rounded shadow">
                        <h2 class="text-xl font-semibold">{{ $reservation->book->title ?? 'Název knihy není k dispozici' }}</h2>
                        <p>Autor: {{ $reservation->book->author->name ?? 'Neznámý autor' }}</p>
                        <p>Datum rezervace:
                            @if($reservation->reserved_at)
                                {{ \Carbon\Carbon::parse($reservation->reserved_at)->format('d.m.Y H:i') }}
                            @else
                                Není k dispozici
                            @endif
                        </p>
                        @if($reservation->returned_at)
                            <p class="text-green-400">Vráceno: {{ \Carbon\Carbon::parse($reservation->returned_at)->format('d.m.Y H:i') }}</p>
                        @else
                            <p class="text-yellow-400">Rezervace aktivní</p>
                            <form action="{{ route('reservations.return', $reservation->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition">
                                    Vrátit knihu
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
