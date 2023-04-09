@extends('layouts.app')

@section('title')
    Index
@endsection
<php
    use Carbon\Carbon;
?>
@section('content')
    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Create New Post</a>
    </div>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">View</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
                <th scope="col">Slug</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post['id'] }}</td>
                    <td>{{ $post['title'] }}</td>
                    @if($post->user)
                        <td>{{ $post->user->name }}</td>
                    @else
                        <td>Guest</td>
                    @endif
                    <td>{{ $post->created_at->format('Y-m-d') }}</td>
                    <td><a href="/posts/{{$post['id']}}" class="btn btn-secondary">View</a></td>
                        <td><a href="{{route('posts.edit', ['id' => $post['id']]) }}"><button class="btn btn-primary">Update</button></a></td>
                        <td><form class="deleteFrom d-inline"  onclick="return confirm('Are you sure you want to delete this post?')"
                    action="{{ route('posts.destroy' , ['post'=>$post['id']] ) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"> Delete</button>
                    </form></td>
                    <td>{{ $post->slug }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}

@endsection