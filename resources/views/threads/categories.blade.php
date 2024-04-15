@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Categories</h1>

    @foreach ($categories as $category)
        <a href="/categories/{{ $category->id }}">
            <div class="bg-white p-4 rounded shadow mb-4">
                <h2 class="text-xl font-bold">{{ $category->name }}</h2>
            </div>
        </a>
    @endforeach
</div>
@endsection