@if(count($errors) > 0)
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        @foreach($errors->all() as $error)
            {{$error}}
            <br>
        @endforeach
    </div>
@endif