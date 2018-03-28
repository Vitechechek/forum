@extends('layouts.main')




@section('category')
    <h4 class="main-content-heading">{{$user->name}}'s profile</h4>
    <br>
    <div class="col-md-3" >
        <div class="dp">
            <img src="{{ asset("storage/$user->image") }}" alt="">
        </div>
    </div>

    <a href="{{url('/changepassword')}}">Change password</a>

    <form action="{{route('change_image')}}" enctype="multipart/form-data" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-outline-primary">Upload</button>
    </form>
@endsection

@section('content')
    @include('layouts.partials.errors')
    @include('layouts.partials.success')

    <div>

        <h3>{{$user->name}}'s latest Threads</h3>

        @forelse($threads as $thread)
            <h5>{{$thread->subject}} {{$thread->created_at->diffForHumans()}}</h5>

        @empty
            <h5>No threads yet</h5>
        @endforelse
        <br>
        <hr>

        <h3>{{$user->name}}'s latest Comments</h3>

        @forelse($comments as $comment)
            <h5>{{$user->name}} commented on <a href="{{route('thread.show',$comment->commentable->id)}}">{{$comment->commentable->subject}}</a>  {{$comment->created_at->diffForHumans()}}</h5>
        @empty
            <h5>No comments yet</h5>
        @endforelse
    </div>

@endsection