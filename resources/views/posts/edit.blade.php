@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
    <form action="{{ route('posts.update', ['id' => $post['id']]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $post['title'] }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{ $post['description'] }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Post Creator</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                <option value="{{$user->id}}" >{{$user->name}}</option>       //@if( $user->id == $post['user_id'] ) selected @endif         
                @endforeach
            </select>
        </div>
        <button class="btn btn-success">Submit</button>
    </form>
@endsection