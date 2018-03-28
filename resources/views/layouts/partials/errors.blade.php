@if(count($errors) > 0)
    <div class="alert alert-dismissible alert-primary">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Oh snap!</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif