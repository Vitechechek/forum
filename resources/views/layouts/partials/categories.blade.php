<h4 class="main-content-heading">Category</h4>
<br>
<ul class="list-group">
    <a href="{{route('thread.index')}}" class="list-group-item d-flex justify-content-between align-items-center">
        All threads
        <span class="badge badge-primary badge-pill">{{$allThreads->count()}}</span>
    </a>
</ul>