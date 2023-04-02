@extends('layouts.app')

@section('title')
    Index
@endsection

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

            </tr>
        </thead>
        <tbody>

            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post['id'] }}</td>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post['posted_by'] }}</td>
                    <td>{{ $post['created_at'] }}</td>
                    <td><a href="/posts/{{$post['id']}}" class="btn btn-secondary">View</a></td>
                        <td><a href="{{route('posts.edit', ['id' => $post['id']]) }}"><button class="btn btn-primary">Update</button></a></td>
                        <td><form class="deleteFrom d-inline"  onclick="return confirm('Are you sure you want to delete this post?')"
                    action="{{ route('posts.destroy' , ['post'=>$post['id']] ) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"> Delete</button>
                    </form></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection