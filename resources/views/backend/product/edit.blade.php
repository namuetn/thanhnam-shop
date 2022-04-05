@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Product</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="POST" action="{{ route('product.update', $product->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="brand_id" class="form-control">
                                                            <option value="" selected disabled>Select Brand</option>
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->name_en }}</option>  
                                                            @endforeach
                                                        </select>
                                                        @error('brand_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id" class="form-control">
                                                            <option value="" selected disabled>Select Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->category_name_en }}</option>  
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Sub Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subcategory_id" class="form-control">
                                                            <option value="" selected disabled>Select Sub Category</option>
                                                            @foreach ($subCategories as $subCategory)
                                                                <option value="{{ $subCategory->id }}" {{ $subCategory->id == $product->subcategory_id ? 'selected' : '' }}>{{ $subCategory->subcategory_name_en }}</option>  
                                                            @endforeach
                                                        </select>
                                                        @error('subcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Sub Sub Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subsubcategory_id" class="form-control">
                                                            <option value="" selected disabled>Select Sub Sub Category</option>
                                                            @foreach ($subsubCategories as $subsubCategory)
                                                                <option value="{{ $subsubCategory->id }}" {{ $subsubCategory->id == $product->subsubcategory_id ? 'selected' : '' }}>{{ $subsubCategory->subsubcategory_name_en }}</option>  
                                                            @endforeach
                                                        </select>
                                                        @error('subsubcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_name_en" value="{{ old('product_name_en', $product->product_name_en) }}" class="form-control" />
                                                        @error('product_name_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Vietnamese <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_name_vi" value="{{ old('product_name_vi', $product->product_name_vi) }}" class="form-control" />
                                                        @error('product_name_vi')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Code <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_code" value="{{ old('product_code', $product->product_code) }}" class="form-control" />
                                                        @error('product_code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Quanlity <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_quanlity" value="{{ old('product_quanlity', $product->product_quanlity) }}" class="form-control" />
                                                        @error('product_quanlity')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Tags English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_tags_en" value="{{ old('product_tags_en', $product->product_tags_en) }}" data-role="tagsinput" class="form-control" />
                                                        @error('product_tags_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Tags Vietnamese <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_tags_vi" value="{{ old('product_tags_vi', $product->product_tags_vi) }}" data-role="tagsinput" class="form-control" />
                                                        @error('product_tags_vi')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Size English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_size_en" value="{{ old('product_size_en', $product->product_size_en) }}" data-role="tagsinput" class="form-control" />
                                                        @error('product_size_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Size Vietnamese <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_size_vi" value="{{ old('product_size_vi', $product->product_size_vi) }}" data-role="tagsinput" class="form-control" />
                                                        @error('product_size_vi')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Color English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_color_en" value="{{ old('product_color_en', $product->product_color_en) }}" data-role="tagsinput" class="form-control" />
                                                        @error('product_color_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Color Vietnamese <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_color_vi" value="{{ old('product_color_vi', $product->product_color_vi) }}" data-role="tagsinput" class="form-control" />
                                                        @error('product_color_vi')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" class="form-control" />
                                                        @error('selling_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}" class="form-control" />
                                                        @error('discount_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Short Description English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="short_description_en" id="textarea" class="form-control">{!! $product->short_description_en !!}</textarea>
                                                        @error('short_description_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Short Description Vietnamese <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="short_description_vi" id="textarea" class="form-control">{!! $product->short_description_vi !!}</textarea>
                                                        @error('short_description_vi')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Long Description English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor1" name="long_description_en" rows="10" cols="80">
                                                            {!! $product->long_description_en !!}
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Long Description Vietnamese <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor2" name="long_description_vi" rows="10" cols="80">
                                                            {!! $product->long_description_vi !!}
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ $product->hot_deals == 1 ? 'checked' : '' }} />
                                                            <label for="checkbox_2">Hot Deals</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $product->featured == 1 ? 'checked' : '' }} />
                                                            <label for="checkbox_3">Featured</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ $product->special_offer == 1 ? 'checked' : '' }} />
                                                            <label for="checkbox_4">Special Offer</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $product->special_deals == 1 ? 'checked' : '' }} />
                                                            <label for="checkbox_5">Special Deals</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                
                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box bt-3 border-info">
                        <div class="box-header">
                            <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                        </div>
                        <form action="{{ route('product.update.multi-image') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row row-sm">
                                @foreach ($multiImage as $image)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <img class="card-img-top" src="{{ asset($image->photo_name) }}" alt="Card image cap" style="height: 130px; width: 280px;">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="{{ route('product.delete.multi-image', $image->id) }}" class="btn btn-danger" id="delete" title="Delete Data">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </h5>
                                                <p class="card-text">
                                                    <div class="form-group">
                                                        <label for="" class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                                        <input type="file" class="form-control" name="multi_image[{{ $image->id }}]">
                                                    </div>
                                                </p>
                                            </div>
                                        </div>    
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">Upddate Image</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box bt-3 border-info">
                        <div class="box-header">
                            <h4 class="box-title">Product Thumnail Image <strong>Update</strong></h4>
                        </div>
                        <form action="{{ route('product.update.thumnail-image', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $product->product_thumnail }}">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset($product->product_thumnail) }}" alt="Card image cap" style="height: 130px; width: 280px;">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <div class="form-group">
                                                    <label for="" class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                                    <input type="file" name="product_thumnail" class="form-control" onchange="mainThumnailUrl(this)" />
                                                    @error('product_thumnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="main_thumnail" alt="">
                                                </div>
                                            </p>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">Upddate Image</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
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
                            $('select[name="subsubcategory_id"]').html('');
                            $('select[name="subsubcategory_id"]').append(
                                '<option value="" selected disabled>Select Sub Category</option>'
                            );
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

                $('select[name="subcategory_id"]').change(function () { 
                    var subcategoryId = $(this).val();
                    if (subcategoryId) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('/categories/sub/sub/ajax') }}/" + subcategoryId,
                            dataType: "json",
                            success: function (data) {
                                $('select[name="subsubcategory_id"]').empty();
                                if (data.length != 0) {
                                    $.each(data, function (key, value) {
                                        $('select[name="subsubcategory_id"]').append(
                                            '<option value="' + value.id + '">' + value.subsubcategory_name_en + '</option>'
                                        );
                                    });
                                } else {
                                    $('select[name="subsubcategory_id"]').append(
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
        });
    </script>

    <script type="text/javascript">
        function mainThumnailUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#main_thumnail').attr('src', e.target.result).width(80).height(80);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $(document).ready(function(){
            $('#multi_image').on('change', function(){ //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) { //check File API supported browser
                    var data = $(this)[0].files; //this file data
                    
                    $.each(data, function(index, file) { //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader

                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80).height(80); //create image element 
                                    $('#preview_image').append(img); //append image to output element
                                };
                            })(file);

                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });
                    
                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
@endsection
