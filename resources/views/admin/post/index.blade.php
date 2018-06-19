@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Post List
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin_dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active" >
                    <a href="{{route('post.create')}}" style="color:#fff" class="btn btn-primary">Create</a>
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            @include('common_functionality.flash_message')
                        </div>
                        <!-- /.box-header -->


                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Owner</th>
                                    <th>Category</th>
                                    <th>Photo</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        <td><img style="height:70px; width:70px;" src="{{ ($post->photo->first()) ? asset('uploads/post/'.$post->photo->first()->path)  : 'http://via.placeholder.com/70x70' }}" alt=""></td>
                                        <td>{{ $post->title }}</td>
                                        <td>{!! $post->body !!}</td>
                                        <td>{{ $post->created_at->diffForHumans() }}</td>
                                        <td>{{ $post->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="col-md-6">
                                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                                            </div>
                                            <div class="col-md-6" style="padding-left: 0px;">
                                                {!! Form::open(['method'=>'delete', 'route'=>['post.destroy', $post->id]]) !!}
                                                    {!! Form::submit('Delete', ['class'=>'btn btn-danger', 'onclick'=>"return confirm('Do you want to delete this post ?')"]) !!}
                                                {!! Form::close() !!}
                                            </div>

                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Owner</th>
                                        <th>Category</th>
                                        <th>Photo</th>
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection