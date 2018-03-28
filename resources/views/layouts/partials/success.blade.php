@if(session('message'))
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Well done!</strong> {{ session('message') }}
    </div>
@endif