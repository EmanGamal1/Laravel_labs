@extends('layouts.app')

@section('title') Create @endsection

@section('content')
<form  class="comment-form" action="{{ route('comments.update', ['id' => $comment['id']]) }}" method="POST">
    @csrf
    @method('PUT')
    <br><label for="content">Update Comment</label>
    <textarea class="form-control" id="content" name="commentContent">{{ $comment['commentContent'] }}</textarea>
    <br><button type="submit" class="btn btn-success">Submit</button>
</form>
    </form>
@endsection
