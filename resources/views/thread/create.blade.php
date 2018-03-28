@extends('layouts.main')

@section('heading', "Create Thread")

@section('category')
    @include('layouts.partials.categories')
@endsection

@section('content')



    <div class="row">
        <div class="col-md-10">
            @include('layouts.partials.errors')
            @include('layouts.partials.success')
                <div class=" well">
                    <form class="form-vertical" action="{{route('thread.store')}}" method="post" role="form"
                          id="create-thread-form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" style="max-width: 60rem;" name="subject" id="" value="{{old('subject')}}" >
                        </div>

                        <div class="form-group">
                            <label for="tag">Type</label>
                            <input type="text" class="form-control" name="type" id="" value="{{old('type')}}">
                        </div>

                        <div class="form-group">
                            <label for="thread">Thread</label>
                            <textarea class="form-control" name="thread" id="" > {{old('thread')}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </div>
        </div>
    </div>


@endsection