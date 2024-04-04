@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Threads</h1>

    <form method="POST" action="/threads">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">Body</label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="body" name="body"></textarea>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Post Thread
            </button>
        </div>
    </form>

    @foreach ($threads as $thread)
    <div class="bg-white p-4 rounded shadow mb-4">
        <div class="border-b border-gray-200 mb-2 pb-2">
            <h2 class="text-xl font-bold">{{ $thread->title }}</h2>
            <p class="text-gray-600 text-sm">Posted by {{ $thread->user->name }} on {{ $thread->created_at->format('M d, Y') }}</p>
        </div>
        <p>{{ $thread->body }}</p>

        <!-- Form to update the current thread -->
        <form method="POST" action="/threads/{{ $thread->id }}">
            @csrf
            @method('PUT')

            <a href="#" onclick="event.preventDefault(); document.getElementById('editForm-{{ $thread->id }}').style.display = 'block';">Edit</a>
            <div id="editForm-{{ $thread->id }}" style="display: none;">

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" value="{{ $thread->title }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="body">Body</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="body" name="body">{{ $thread->body }}</textarea>
            </div>
            <button type="submit">Update Thread</button>
        </form>
    </div>
</div>
@endforeach
    </div>
@endsection