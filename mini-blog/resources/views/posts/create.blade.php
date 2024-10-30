@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Create a New Blog Post</h1>

    <form action="/posts" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body:</label>
            <textarea id="body" name="body" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Banner Image:</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Create Post</button>
    </form>

    <a href="/posts" class="btn btn-secondary mt-4">Back to Posts</a>
@endsection
