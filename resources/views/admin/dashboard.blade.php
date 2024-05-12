@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl mt-4 mb-8">Admin Dashboard</h1>

    <div class="bg-white shadow-md rounded my-6">
        <!-- User table -->
        <table class="text-left w-full border-collapse">
            <thead>
                <tr>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">User ID</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Email</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="hover:bg-grey-lighter">
                    <td class="py-4 px-6 border-b border-grey-light">{{ $user->id }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">{{ $user->name }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">{{ $user->email }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-800 ml-4">Delete</button>
                        </form>
                        <a href="?userId={{ $user->id }}" class="text-green-500 hover:text-green-800 ml-4">Load Threads</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Thread table -->
        @foreach($users as $user)
            @if(request('userId') == $user->id)
                <h2 class="text-2xl mt-4 mb-4">Threads by {{ $user->name }}</h2>
                <table class="text-left w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Thread ID</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Title</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Body</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->threads as $thread)
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">{{ $thread->id }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $thread->title }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $thread->body }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <a href="{{ route('admin.threads.edit', $thread) }}" class="text-blue-500 hover:text-blue-800">Edit</a>
                                <form action="{{ route('admin.threads.delete', $thread) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this thread?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-800 ml-4">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endforeach
    </div>
</div>
@endsection