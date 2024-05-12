@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
        <h2 class="text-2xl font-bold mb-5 text-gray-900">{{ __('Update BBCode') }}</h2>

        <form method="POST" action="{{ route('profile.bbcode') }}">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="bbcode" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">{{ __('BBCode') }}</label>
                <textarea id="bbcode" class="form-input w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-blue-100" name="bbcode" required autofocus>{{ old('bbcode', auth()->user()->bbcode) }}</textarea>

                @error('bbcode')
                    <span class="text-red-500 text-sm mt-2">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="w-full p-3 mt-4 bg-indigo-600 text-white rounded shadow hover:bg-indigo-500">
                {{ __('Update BBCode') }}
            </button>
        </form>
    </div>
</div>
@endsection