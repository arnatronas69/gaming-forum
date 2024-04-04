@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Posts</h1>

    @foreach ($posts as $post)
    <div class="bg-white p-4 rounded shadow mb-4">
        <h3>{{ $post->user->name }}</h3> 
        <p>{{ $post->body }}</p>
    </div>
@endforeach
@endsection