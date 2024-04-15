@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">{{ $category->name }}</h1>

    @foreach ($threads as $thread)
    <div class="bg-white p-4 rounded shadow mb-4">
        <h2 class="text-xl font-bold">{{ $thread->title }}</h2>
        <p>{{ $thread->body }}</p>
    </div>
    @endforeach

    {{ $threads->links() }}
</div>
@endsection