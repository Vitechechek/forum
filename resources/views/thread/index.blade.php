@extends('layouts.main')

@section('heading', "Treads")

@section('createThread')
    @include('thread.partials.create-thread')
@endsection

@section('category')
    @include('layouts.partials.categories')
@endsection

@section('content')

    @include('thread.partials.thread-list')

@endsection