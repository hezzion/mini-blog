@extends('layouts.app')

@section('content')
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .btn {
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .search-bar {
            margin-bottom: 20px;
        }
    </style>

    <div class="container">
        <h1 class="mb-4 text-center">Blog Posts</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Search Bar -->
        <form action="{{ route('posts.search') }}" method="GET" class="search-bar">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="query" placeholder="Search posts..." aria-label="Search posts">
                <div class="input-group-append">
                </div>
            </div>
        </form>

        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->body, 100) }}</p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning text-white">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#postModal{{ $post->id }}">
                                    <i class="fas fa-eye"></i> Read More
                                </button>

                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for the post -->
                <div class="modal fade" id="postModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="postModalLabel{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="postModalLabel{{ $post->id }}">{{ $post->title }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>{{ $post->body }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="/posts/create" class="btn btn-primary mt-4">
                <i class="fas fa-plus"></i> Create a new post
            </a>
        </div>
    </div>
@endsection
