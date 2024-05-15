@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Received messages</h1>

        <div class="mb-4">
            <a href="{{ route('messages.create') }}" class="bg-green-500 text-black rounded px-4 py-2">Create a new Message</a>
        </div>

        @foreach ($messages as $message)
            <div class="bg-white shadow rounded-lg p-6 mb-4">
                <h2 class="text-xl font-bold mb-2">{{ $message->title }}</h2>
                <p class="text-gray-700 mb-2">From: {{ $message->sender->name }}</p>
                <p class="text-gray-700 mb-4">{{ $message->content }}</p>

                <div class="flex items-center">
                    <a href="{{ route('messages.reply', $message->id) }}" class="bg-blue-500 text-white rounded px-4 py-2 mr-2">Reply</a>
                    <form method="POST" action="{{ route('messages.destroy', $message->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-black rounded px-4 py-2">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection