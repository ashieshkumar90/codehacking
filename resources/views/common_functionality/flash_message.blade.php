@if(Session::has('msg'))
    <div class="{{ Session::get('class') }} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Congratulation!</strong> {{ Session::get('msg') }}
    </div>
@endif