@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                {{-- ---- Add Brand Page ---- --}}
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Slider</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('slider.update', $slider->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="old_image" value="{{ $slider->slider_image }}">
                                    <div class="form-group">
                                        <h5>Slider Title<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="title" class="form-control" value="{{ old('title', $slider->title) }}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Slider Description<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="description" class="form-control" value="{{ old('description', $slider->description) }}" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Slider Image</h5>
                                        <div class="controls">
                                            <input type="file" name="slider_image" class="form-control" value="{{ old('slider_image', $slider->slider_image) }}" />
                                        </div>
                                        @error('slider_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Update">
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
