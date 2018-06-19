@extends('admin.layout.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Category List
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin_dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active" >
                    <a href="{{route('category.create')}}" style="color:#fff" class="btn btn-primary">Create</a>
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
                                    <th>Category</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at->diffForHumans() }}</td>
                                        <td>{{ $category->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="col-md-6">
                                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                                            </div>
                                            <div class="col-md-6" style="padding-left: 0px;">
                                                {!! Form::open(['method'=>'delete', 'route'=>['category.destroy', $category->id]]) !!}
                                                    {!! Form::submit('Delete', ['class'=>'btn btn-danger', 'onclick'=>"return confirm('Do You want to delete this Category')"]) !!}
                                                {!! Form::close() !!}
                                            </div>

                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
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