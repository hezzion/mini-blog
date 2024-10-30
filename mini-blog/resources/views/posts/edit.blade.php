@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Post</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" class="form-control" rows="5" required>{{ $post->body }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Banner Image (optional)</label>
                <input type="file" name="image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-success">Update Post</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
