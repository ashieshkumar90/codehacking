@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit
                <small>Post</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{route('post.index')}}" class="btn btn-primary" style="color: #ffffff;">View</a></li>
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

                        <div class="box-body">
                            {!! Form::model($post,['method'=>'PATCH', 'route'=>['post.update', $post->id], 'files'=>true]) !!}
                            <img style="height: 70px; width: 70px;" class="img-responsive img-circle profile-user-img" src="{{ ($post->photo->first()) ? asset('uploads/post/'.$post->photo->first()->path) : 'http://via.placeholder.com/70x70' }}" alt="">
                            <div class="form-group">
                                {!! Form::label('title', 'Title') !!}
                                {!! Form::text('title', null, ['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('category_id', 'Category') !!}
                                {!! Form::select('category_id', $categories, null, ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::file('path') !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('body', 'Description') !!}
                                {!! Form::textarea('body', null, ['id'=>'editor1']) !!}
                            </div>
                            <div class="box-footer ">
                                {!! Form::submit('Submit', ['class'=>'btn btn-primary pull-right']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.box -->

                </div>
                <!--/.col (left) -->
                <div class="col-md-6">
                    @include('common_functionality.validation_error')
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection