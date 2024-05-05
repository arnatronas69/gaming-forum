@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Upload Profile Picture') }}</div>

                    <div class="card-body">
                        <form action="{{ route('user.profile.picture.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="picture">{{ __('Profile Picture') }}</label>
                                <input type="file" class="form-control" id="picture" name="picture" required>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection