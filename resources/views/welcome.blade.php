@extends('layouts.main')

@section('banner')
    <div class="jumbotron">
        <div class="container">
            <h1>Join our community</h1>
            <p>Help and get help.</p>
            <p>
                <a class="btn btn-outline-primary btn-lg">Learn more</a>
            </p>
        </div>
    </div>
@endsection
@section('heading', "Threads")
@section('createThread')
    @include('thread.partials.create-thread')
@endsection

@section('category')
    @include('layouts.partials.categories')
@endsection

@section('content')
    @include('thread.partials.thread-list')
@endsection