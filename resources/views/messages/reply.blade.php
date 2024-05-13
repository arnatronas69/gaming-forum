@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Reply to Message</h1>

        <form method="POST" action="{{ route('messages.reply.store', $message->id) }}">
            @csrf

            <input type="hidden" name="recipient_id" value="{{ $message->sender->id }}">

            <div class="mb-4">
                <label for="content" class="block text-gray-700">Message</label>
                <textarea id="content" name="content" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" placeholder="Write your reply..." required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Send Reply</button>
        </form>
    </div>
@endsection