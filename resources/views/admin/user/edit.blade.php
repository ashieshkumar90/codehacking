@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                General Form Elements
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">General Elements</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Quick Example</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        {!! Form::model($user, ['route'=>['user.update', $user->id], 'files'=>true, 'method'=>'patch']) !!}
                        <div class="box-body">
                            <img class="profile-user-img img-responsive img-circle" style="height: 100px" src="{{ asset($profile_photo)  }}" alt="User profile picture">
                            <div class="form-group">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Enter Email']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', 'Password') !!}
                                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Enter password']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('is_active', 'Active') !!}
                                <br>
                                {!! Form::radio('is_active', 0, true) !!} Inactive
                                &nbsp;&nbsp;
                                {!! Form::radio('is_active', 1) !!} Active

                            </div>

                            <!-- select -->
                            <div class="form-group">
                                {!! Form::label('role_id', 'Role') !!}
                                {!! Form::select('role_id', $roles, null, ['class'=>'form-control', 'placeholder'=>'select Role']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('photo_id', 'Profile Pic') !!}
                                {!! Form::file('photo_id') !!}
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer ">
                            {!! Form::submit('Submit', ['class'=>'btn btn-primary pull-right']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.box -->

                </div>
                <!--/.col (left) -->

                <div class="col-md-6">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            @foreach($errors->all() as $error)
                                {{$error}}
                                <br>
                            @endforeach
                        </div>
                    @endif
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@stop