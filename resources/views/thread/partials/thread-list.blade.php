@include('layouts.partials.errors')
@include('layouts.partials.success')

@forelse($threads as $thread)

    <div class="col-md-11 ">
        <a href="{{ route('thread.show', $thread->id) }}" class="cardLink">
            <div class="card border-primary mb-3" style="max-width: 60rem;">
                <div class="card-header"><h4>{{ $thread->subject }}</h4></div>
                <div class="card-body">
                    <p class="card-text">{{ str_limit($thread->thread, 100 )}}</p>
                    <hr>
                    <lead><em style="color: black;">Created by: </em><a href="{{route('user_profile', $thread->user->name)}}">{{$thread->user->name}}</a> <em>{{$thread->created_at ? $thread->created_at->diffForHumans(): '-'}}</em></lead>
                </div>
            </div>
        </a>
    </div>

@empty
    <div class="col-md-11 offset-md-1">
        <h3>There is no threads yet.</h3>
    </div>
@endforelse