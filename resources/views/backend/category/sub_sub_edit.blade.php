@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Sub Sub Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('subsubcategory.update', $subsubcategory->id) }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control">
                                                <option value="" selected disabled>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $subsubcategory->category_id ? 'selected' : '' }}>{{ $category->category_name_en }}</option>  
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id" class="form-control">
                                                <option value="" selected disabled>Select Sub Category</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" {{ $subcategory->id == $subsubcategory->subcategory_id ? 'selected' : '' }}>{{ $subcategory->subcategory_name_en }}</option>  
                                                @endforeach
                                            </select>
                                            @error('subcategory_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub Sub Category Name English<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_en" class="form-control" value="{{ old('subsubcategory_name_en', $subsubcategory->subsubcategory_name_en) }}" />
                                        </div>
                                        @error('subsubcategory_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub Sub Category Name Vietnamese<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_vi" class="form-control" value="{{ old('subsubcategory_name_vi', $subsubcategory->subsubcategory_name_vi) }}"/>
                                        </div>
                                        @error('subsubcategory_name_vi')
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="category_id"]').change(function () { 
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/categories/sub/ajax') }}/" + categoryId,
                        dataType: "json",
                        success: function (data) {
                            $('select[name="subcategory_id"]').empty();
                            if (data.length != 0) {
                                $.each(data, function (key, value) {
                                    $('select[name="subcategory_id"]').append(
                                        '<option value="' + value.id + '">' + value.subcategory_name_en + '</option>'
                                    );
                                });
                            } else {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="" selected disabled>Select Sub Category</option>'
                                );
                            }
                        },
                    });
                } else {
                    alert('error');
                }
            });
        });
    </script>
@endsection