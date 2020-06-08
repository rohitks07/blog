@extends('admin.app')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Products</a></li>
@endsection
@section('content')
        <h2 class="modal-title">Add Products</h2>
<form action="{{route('admin.product.store')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-lg-9">
            <div class="form-group row">
                <div class="col-sm-12">
                    @if (session()->has('message'))
                    <div class="alert alert-success" style="text-align:center;">
                        {{session('message')}}
                    </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    <label class="form-control-label">Title: </label>
                    <input type="text" id="txturl" name="title" class="form-control" value="">
                    <p class="small">
                        {{config('app.url')}}<span id="url"></span>
                        <input type="hidden" name="slug" id="slug" value="" />
                    </p>
                    @if ($errors->has('title'))
                        @foreach($errors->get('title') as $error)
                        <p class="alert alert-danger" style="text-align:center;">
                            <strong>{{ $error }}</strong>
                        </p>
                        @endforeach
                    @endif
                    @if ($errors->has('slug'))
                        @foreach($errors->get('slug') as $error)
                        <p class="alert alert-danger" style="text-align:center;">
                            <strong >{{ $error }}</strong>
                        </p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label class="form-control-label">Description: </label>
                    <textarea name="description" id="editor" class="form-control"></textarea>&nbsp;
                    @if ($errors->has('description'))
                        @foreach($errors->get('description') as $error)
                        <p class="alert alert-danger" style="text-align:center;">
                            <strong>{{ $error }}</strong>
                        </p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label class="form-control-label">Price: </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="text" class="form-control" placeholder="0.00" aria-label="Username" aria-describedby="basic-addon1" name="price" value="{{@$product->price}}" />
                    </div>
                        @if ($errors->has('price'))
                            @foreach($errors->get('price') as $error)
                            <p class="alert alert-danger" style="text-align:center;">
                                <strong>{{ $error }}</strong>
                            </p>
                            @endforeach
                        @endif
                </div>
                <div class="col-6">
                    <label class="form-control-label">Discount: </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="text" class="form-control" name="discount_price" placeholder="0.00" aria-label="discount_price" aria-describedby="discount" value="{{@$product->discount_price}}" />
                    </div>
                        @if ($errors->has('discount_price'))
                            @foreach($errors->get('discount_price') as $error)
                            <p class="alert alert-danger" style="text-align:center;">
                                <strong>{{ $error }}</strong>
                            </p>
                            @endforeach
                        @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="card col-sm-12 p-0 mb-2">
                    <div class="card-header align-items-center">
                        <h5 class="card-title float-left">Extra Options</h5>
                        <div class="float-right">
                            <button type="button" id="btn-add" class="btn btn-primary btn-sm">+</button>
                            <button type="button" id="btn-remove" class="btn btn-danger btn-sm">-</button>
                        </div>
                    </div>
                    <div class="card-body" id="extras">
                    <!-- my code is extras.blade.php -->

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <ul class="list-group row">
                <li class="list-group-item active"><h5>Status</h5></li>
                <li class="list-group-item">
                    <div class="form-group row">
                        <select class="form-control" id="status" name="status">
                            <option value="0">Pending</option>
                            <option value="1">Publish</option>
                        </select>&nbsp;
                        @if ($errors->has('status'))
                            @foreach($errors->get('status') as $error)
                                <p class="alert alert-danger" style="text-align:center;">
                                    <strong>{{ $error }}</strong>
                                </p>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Add Product">
                        </div>
                    </div>
                </li>
                <li class="list-group-item active"><h5>Featured Image</h5></li>
                <li class="list-group-item">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail" id="thumbnail" />
                            <label class="custom-file-label" for="thumbnail">Choose file</label>
                        </div>
                    </div>
                    <div class="img-thumbnail text-center">
                        <img src="{{asset('public/images/no-thumbnail.jpeg')}}" id="imgthumbnail" class="img-fluid" alt="" />
                    </div>&nbsp;
                    @if ($errors->has('thumbnail'))
                        @foreach($errors->get('thumbnail') as $error)
                        <p class="alert alert-danger" style="text-align:center;">
                            <strong>{{ $error }}</strong>
                        </p>
                        @endforeach
                    @endif
                </li>
                <li class="list-group-item">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <input id="featured" type="checkbox" name="featured" value="">
                                </span>
                            </div>
                            <p type="text" class="form-control" name="featured" placeholder="0.00" aria-label="featured" aria-describedby="featured">Featured Product</p>
                        </div>
                    </div>
                </li>

                <li class="list-group-item active"><h5>Select Categories</h5></li>
                <li class="list-group-item">
                    <select class="form-control" name="category_id[]"  id="selectCategory" multiple>
                        @if($categories->count() > 0 )
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        @endif
                    </select>&nbsp;
                    @if ($errors->has('category_id'))
                        @foreach($errors->get('category_id') as $error)
                        <p class="alert alert-danger" style="text-align:center;">
                            <strong>{{ $error }}</strong>
                        </p>
                        @endforeach
                    @endif
                </li>
            </ul>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        ClassicEditor.create(document.querySelector("#editor"), {
            toolbar: ["Heading", "Link", "bold", "italic", "bulletedList", "numberedList", "blockQuote", "undo", "redo"],
        })
            .then((editor) => {
                console.log(editor);
            })
            .catch((error) => {
                console.error(error);
            });

        $("#txturl").on("keyup", function () {
            const pretty_url = slugify($(this).val());
            $("#url").html(slugify(pretty_url));
            $("#slug").val(pretty_url);
        });

        $("#selectCategory").select2({
            placeholder: "Select multiple Categories",
            allowClear: true,
            minimumResultsForSearch: Infinity,
        });

        $("#thumbnail").on("change", function () {
            var file = $(this).get(0).files;
            var reader = new FileReader();
            reader.readAsDataURL(file[0]);
            reader.addEventListener("load", function (e) {
                var image = e.target.result;
                $("#imgthumbnail").attr("src", image);
            });
        });

        // ajax call
        $("#btn-add").on("click",function(e){
            var count = $(".options").length + 1;
            $.get("{{route('admin.product.extras')}}").done(function (data){
                $('#extras').append(data);
            });
        });

        //it is normal append
        // $("#btn-add").on("click", function (e) {
        //     var count = $(".options").length + 1;
        //     // console.log(count);
        //     $('#extras').append(`<div class="row align-items-center options">
        //                     <div class="col-sm-4">
        //                         <label class="form-control-label">Option <span>`+count+`</span></label>
        //                         <input type="text" class="form-control" name="extra[option][]" placeholder="size">
        //                     </div>
        //                     <div class="col-sm-8">
        //                         <label class="form-control-label">Values </label>
        //                         <input type="text" class="form-control" name="extra[values][]" placeholder="option1 | option2 | option3">
        //                         <label class="form-control-label">Additional Prices</label>
        //                         <input type="text" class="form-control" name="extra[prices][]" placeholder="price1 | price2 | price3">
        //                     </div>
        //                 </div>`);
        // });

        $("#btn-remove").on("click", function (e) {
            if($('.options').length > 1){
                $(".options:last").remove();
            }
        });
        $("#featured").on("change", function () {
            if ($(this).is(":checked")) $(this).val(1);
            else $(this).val(0);
        });
    });
</script>
@endsection



