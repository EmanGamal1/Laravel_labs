@extends('layouts.app')

@section('title') Index @endsection

@section('content')
    <div class="text-center">
        <a href="/posts/create"><button type="button" class="mt-4 btn btn-success">Create Post</button></a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                <td>{{$post['id']}}</td>
                <td>{{$post['title']}}</td>
                <td>{{$post['posted_by']}}</td>
                <td>{{$post['created_at']}}</td>
                <td>
                    <a href="/posts/{{$post['id']}}" class="btn btn-secondary">View</a>
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="/posts" onclick="return confirm('Are you sure you want to delete this post?')" class="btn btn-danger">Delete</a>
                </td>
            </tr>

        @endforeach


        </tbody>
    </table>

@endsection

