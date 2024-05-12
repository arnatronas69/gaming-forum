@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">{{ $category->name }}</h1>

    <form method="POST" action="/categories/{{ $category->id }}/threads">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" onkeyup="updateCount(this, 200)">
            <span id="title-count">0/200</span>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">Body</label>
            <textarea id="body" name="body"></textarea>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Post Thread
            </button>
        </div>
    </form>

    @foreach ($threads as $thread)
    <div class="bg-white p-4 rounded shadow mb-4">
        <h2 class="text-xl font-bold">{{ $thread->title }}</h2>
        <p>Posted by: <img src="{{ asset('images/' . $thread->user->profile_picture) }}" alt="{{ $thread->user->name }}'s profile picture" style="width: 40px; height: 40px;">
            {{ $thread->user->name }} at {{ $thread->created_at }}</p>
        <div>{!! \Parsedown::instance()->text($thread->body) !!}</div>
        @if (auth()->id() == $thread->user_id)
            <form method="POST" action="/threads/{{ $thread->id }}">
                @csrf
                @method('PUT')
                <a href="#" onclick="event.preventDefault(); document.getElementById('editForm-{{ $thread->id }}').style.display = 'block';">Edit</a>
                <div id="editForm-{{ $thread->id }}" style="display: none;">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title-{{ $thread->id }}" type="text" name="title" value="{{ $thread->title }}" onkeyup="updateCount(this, 200)">
                        <span id="title-{{ $thread->id }}-count">{{ strlen($thread->title) }}/200</span>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="body">Body</label>
                        <textarea id="body-{{ $thread->id }}" name="body">{{ $thread->body }}</textarea>
                    </div>
                    <button type="submit">Update Thread</button>
                </div>
            </form>
        @endif

        <!-- Display the user's BBCode -->
        <div class="mt-4 p-4 bg-gray-100 rounded">
            <p>{!! $thread->user->bbcode !!}</p>
        </div>
    </div>
    @endforeach

    {{ $threads->links() }}
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script>
    var bodyElement = document.getElementById("body");
    if (bodyElement) {
        var simplemde1 = new SimpleMDE({ element: bodyElement });
    }

    @foreach ($threads as $thread)
        var bodyThreadElement = document.getElementById("body-{{ $thread->id }}");
        if (bodyThreadElement) {
            var simplemde2 = new SimpleMDE({ element: bodyThreadElement });
        }
    @endforeach

    function updateCount(element, limit) {
        var count = element.value.length;
        document.getElementById(element.id + '-count').textContent = count + '/' + limit;
    }
</script>
@endsection