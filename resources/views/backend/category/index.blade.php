@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Category List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Category Icon</th>
                                            <th>Category English</th>
                                            <th>Category Vietnamese</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td><span><i class="{{ $category->category_icon }}"></i></span></td>
                                                <td>{{ $category->category_name_en }}</td>
                                                <td>{{ $category->category_name_vi }}</td>
                                                <td>
                                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info">Edit</a>
                                                    <a href="{{ route('category.delete', $category->id) }}" id="delete" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                {{-- ---- Add Category Page ---- --}}
                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('category.store') }}">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <h5>Category Name English<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="category_name_en" class="form-control" value="{{ old('category_name_en') }}" />
                                        </div>
                                        @error('category_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Category Name Vietnamese<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="category_name_vi" class="form-control" value="{{ old('category_name_vi') }}" />
                                        </div>
                                        @error('category_name_vi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Category Icon<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="category_icon" class="form-control" value="{{ old('category_icon') }}"/>
                                        </div>
                                        @error('category_icon')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
