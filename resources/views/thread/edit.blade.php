@extends('layouts.main')

@section('heading', "Create Thread")

@section('category')
    @include('layouts.partials.categories')
@endsection

@section('content')



    <div class="row">
        <div class="col-md-10 offset-md-1">
            @include('layouts.partials.errors')
            @include('layouts.partials.success')
            <div class=" well">
                <form class="form-vertical" action="{{route('thread.update', $thread->id)}}" method="post" role="form"
                      id="create-thread-form">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" style="max-width: 60rem;" name="subject" id="" value="{{$thread->subject}}" >
                    </div>

                    <div class="form-group">
                        <label for="tag">Type</label>
                        <input type="text" class="form-control" name="type" id="" value="{{$thread->type}}">
                    </div>

                    <div class="form-group">
                        <label for="thread">Thread</label>
                        <textarea class="form-control" name="thread" id="" > {{$thread->thread}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>


@endsection