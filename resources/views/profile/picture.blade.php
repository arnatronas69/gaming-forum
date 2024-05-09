@extends('layouts.app')

@section('content')
    <div class="mt-6 mx-4">
        <div class="w-full max-w-2xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <h2 class="text-2xl font-bold mb-6">{{ __('Upload Profile Picture') }}</h2>
            </div>

            <div class="mb-4">
                <img src="{{ asset('images/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="rounded-full h-32 w-32 object-cover">
            </div>

            <form action="{{ route('user.profile.picture.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="picture" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Profile Picture') }}</label>
                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="picture" name="picture" required>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        {{ __('Upload') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection