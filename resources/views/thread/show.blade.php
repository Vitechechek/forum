@extends('layouts.main')

@section('category')
    @include('layouts.partials.categories')
@endsection

@section('createThread')
    @include('thread.partials.create-thread')
@endsection

@section('content')

    <div class="col-md-11">
        @include('layouts.partials.errors')
        @include('layouts.partials.success')

        <div class="card border-primary mb-3" style="max-width: 60rem;">
            <div class="card-header"><h4>{{ $thread->subject }}</h4></div>
            <div class="card-body">
                <p class="card-text">{!! \Michelf\Markdown::defaultTransform($thread->thread) !!}</p>
                <lead><em>Created by: </em><a href="{{route('user_profile', $thread->user->name)}}">{{$thread->user->name}}</a> <em>{{$thread->created_at->diffForHumans()}}</em></lead>
            </div>
            @if(auth()->user()->id == $thread->user_id)
                <div class="card-footer">
                    <div class="actions">
                        <a href="{{ route('thread.edit', $thread->id) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>

                        <form action="{{ route('thread.destroy', $thread->id) }}" method="post" class="inline-it">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-trash-alt"></i> Delete</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        @foreach($thread->comments as $comment)
            <div class="comment-list">

                <div class="card @if($thread->solution == $comment->id) border-success @else border-dark @endif mb-3" style="max-width: 60rem;">
                    <div class="card-body">
                        <p class="card-text">{!! \Michelf\Markdown::defaultTransform($comment->comment) !!}</p>
                        <hr>
                        <lead><em>Created by: </em><a href="{{route('user_profile', $comment->user->name)}}">{{$comment->user->name}}</a> <em>{{$comment->created_at->diffForHumans()}}</em></lead>
                    </div>
                    <div class="card-footer">
                        <div class="actions">
                            <button class="btn btn-sm btn-secondary likeIt {{$comment->isLiked()?"liked":"unliked"}}" id="{{$comment->id}}"><span>{{$comment->likes()->count()}} </span><i class="fas fa-heart"></i></button>
                            <button class="btn btn-sm btn-secondary toggleReply" id="{{$comment->id}}"><i class="fas fa-reply"></i> Reply</button>
                            @if(auth()->user()->id == $thread->user_id)
                                <form class="inline-it" action="{{route('markAsSolution')}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="solutionId" value="{{$comment->id}}">
                                    <input type="hidden" name="threadId" value="{{$thread->id}}">
                                    <button type="submit" class="btn btn-sm btn-success" ><i class="fas fa-check-circle"></i>Solution</button>
                                </form>
                            @endif
                            @if(auth()->user()->id == $comment->user_id)

                                <a href="#{{$comment->id}}" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>

                                <div class="modal fade" id="{{$comment->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit comment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('comment.update', $comment->id)}}" method="post" role="form">
                                                <div class="modal-body">

                                                    {{csrf_field()}}
                                                    {{method_field('put')}}
                                                    <div class="form-group row">
                                                        <textarea class="form-control" name="comment" id="" >{{$comment->comment}}</textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="inline-it">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-secondary mb-3 reply-form-{{$comment->id}} d-none" style="max-width: 60rem;">
                <div class="card-header"><h4>Reply</h4></div>
                <div class="card-body">
                    <form action="{{route('replycomment.store', $comment->id)}}" method="post" role="form">
                        {{csrf_field()}}

                        <div class="form-group row">
                            <textarea class="form-control" name="comment" id="" ></textarea>
                        </div>
                        <div class="form-group row">
                            <button type="submit" class="btn btn-sm btn-secondary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            @foreach($comment->comments as $reply)
                <div class="well reply-list">

                    <div class="card bg-secondary mb-3" style="max-width: 60rem; margin-left: 40px;">
                        <div class="card-body">
                            <p class="card-text">{!! \Michelf\Markdown::defaultTransform($reply->comment) !!}</p>
                            <hr>
                            <lead><em>Created by: </em><a href="{{route('user_profile', $reply->user->name)}}">{{$reply->user->name}}</a> <em>{{$reply->created_at->diffForHumans()}}</em></lead>
                        </div>
                        @if(auth()->user()->id == $reply->user_id)
                            <div class="card-footer">
                                <div class="actions">

                                    <a href="#{{$reply->id}}" data-target="#{{$reply->id}}" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>

                                    <div class="modal fade" id="{{$reply->id}}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit comment</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('comment.update', $reply->id)}}" method="post" role="form">
                                                    <div class="modal-body">

                                                        {{csrf_field()}}
                                                        {{method_field('put')}}
                                                        <div class="form-group row">
                                                            <textarea class="form-control" name="comment" id="" >{{$reply->comment}}</textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{ route('comment.destroy', $reply->id) }}" method="post" class="inline-it">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-trash-alt"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

            @endforeach

        @endforeach

        <div class="card border-secondary mb-3" style="max-width: 60rem; color: #D9230F;">
            <div class="card-header"><h4>Create comment</h4></div>
            <div class="card-body">
                <form action="{{route('threadcomment.store', $thread->id)}}" method="post" role="form">
                    {{csrf_field()}}

                    <div class="form-group row">
                        <textarea class="form-control" name="comment" id="" ></textarea>
                    </div>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $( document ).ready(function() {
            $('.toggleReply').on('click', function () {
                var commentId = $(this).attr('id');
                $('.reply-form-' + commentId).toggleClass('d-none');
            });

            $.ajaxSetup({
                beforeSend: function(xhr, type) {
                    if (!type.crossDomain) {
                        xhr.setRequestHeader('X-CSRF-Token', '{{csrf_token()}}');
                    }
                },
            });

            $('.likeIt').on('click', function () {
                var commentId = $(this).attr('id');
                var csrfToken = '{{csrf_token()}}';
                var elem = $(this);
                var text = $(this).children('span');

                $.ajax({
                    url: '{{route('toggleLike')}}',
                    dataType : 'json',
                    type: 'POST',
                    data: {commentId: commentId, _token: csrfToken},
                    success:function(response) {
                        console.log(response);

                        if(response.message === 'liked')
                        {
                            elem.addClass('liked');
                            text.text(response.likes + " ");

                        }else
                        {
                            elem.removeClass('liked');
                            text.text(response.likes + " ");
                        }
                    }
                });
            });
        });
    </script>
@endsection