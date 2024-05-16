@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="mb-4">
            <button id="toggleButton" class="bg-blue-500 text-white rounded px-4 py-2">Show Sent Messages</button>
            <a href="{{ route('messages.create') }}" class="bg-green-500 text-black rounded px-4 py-2">Create a new Message</a>
        </div>

        <div id="receivedMessages">
            <h1 class="text-2xl font-bold mb-4">Received messages</h1>

            @foreach ($receivedMessages as $message)
                <div class="bg-white shadow rounded-lg p-6 mb-4">
                    <h2 class="text-xl font-bold mb-2">{{ $message->title }}</h2>
                    <p class="text-gray-700 mb-2">From: {{ $message->sender->name }}</p>
                    <p class="text-gray-700 mb-4">{{ $message->content }}</p>
                    <p class="text-gray-500 text-sm">Sent at: {{ $message->created_at->format('d M Y, H:i') }}</p>

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

        <div id="sentMessages" style="display: none;">
            <h1 class="text-2xl font-bold mb-4">Sent messages</h1>

            @foreach ($sentMessages as $message)
                <div class="bg-white shadow rounded-lg p-6 mb-4">
                    <h2 class="text-xl font-bold mb-2">{{ $message->title }}</h2>
                    <p class="text-gray-700 mb-2">To: {{ $message->receiver->name }}</p>
                    <p class="text-gray-700 mb-4">{{ $message->content }}</p>
                    <p class="text-gray-500 text-sm">Sent at: {{ $message->created_at->format('d M Y, H:i') }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.getElementById('toggleButton').addEventListener('click', function() {
            var receivedMessages = document.getElementById('receivedMessages');
            var sentMessages = document.getElementById('sentMessages');

            if (receivedMessages.style.display === 'none') {
                receivedMessages.style.display = 'block';
                sentMessages.style.display = 'none';
                this.textContent = 'Show Sent Messages';
            } else {
                receivedMessages.style.display = 'none';
                sentMessages.style.display = 'block';
                this.textContent = 'Show Received Messages';
            }
        });
    </script>
@endsection