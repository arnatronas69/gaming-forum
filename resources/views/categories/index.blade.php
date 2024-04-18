@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Categories</h1>

        @foreach($categories as $category)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-xl font-bold text-gray-900">
                        <a href="/categories/{{ $category->id }}" class="text-blue-500 hover:text-blue-700">
                            {{ $category->name }}
                        </a>
                    </h2>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $category->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection