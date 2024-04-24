@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl mt-4 mb-8">Delete Thread</h1>

    <p>Are you sure you want to delete this thread?</p>

    <form action="{{ route('admin.threads.delete', $thread) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">Delete Thread</button>
    </form>
</div>
@endsection