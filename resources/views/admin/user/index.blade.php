@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                User List
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin_dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active" >
                    <a href="{{route('user.create')}}" style="color:#fff" class="btn btn-primary">Create</a>
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            @if(Session::has('msg'))
                                <div class="{{ Session::get('class') }} alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Congratulation!</strong> {{ Session::get('msg') }}
                                </div>
                            @endif
                        </div>
                        <!-- /.box-header -->


                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>Image</th>
                                    <th>email</th>
                                    <th>Role</th>
                                    <th>Active</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$user->name}}</td>
                                            <td><img style="height: 50px; width:50px;" src="{{$user->photo->first()['path'] ? asset($user->photo->first()['path']) : 'http://www.placeholde.com/50x50'}}" alt=""></td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->role->name}}</td>
                                            <td>{{$user->is_active ? 'Active' : 'Inactive'}}</td>
                                            <td>{{$user->created_at->diffForHumans()}}</td>
                                            <td>{{$user->updated_at->diffForHumans()}}</td>
                                            <td>
                                                <div class="col-md-6">
                                                    <a href="{{route('user.edit', $user->id)}}" class="btn btn-primary">Edit</a>
                                                </div>
                                                <div class="col-md-6" style="padding-left: 0px;">
                                                    {!! Form::open(['method'=>'delete', 'route'=>['user.destroy', $user->id] ]) !!}
                                                        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                </div>

                                                {{--<a href="" class="btn btn-danger">Delete</a>--}}

                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>Image</th>
                                    <th>email</th>
                                    <th>Role</th>
                                    <th>Active</th>
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