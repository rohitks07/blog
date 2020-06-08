@extends('admin.app')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Categories</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
@endsection
@section('content')
<form action="{{route('admin.category.update',$category->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group-row">
        <div class="col-sm-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
    <div class="form-group-row">
        <div class="col-sm-12">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message')}}
            </div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="form-control-label">Title: </label>
            <input type="text" class="form-control" id="txturl" name="title" value="{{$category->title}}" placeholder="Enter Title">
            <p class="small">{{config('app.url')}}<span id="url">{{$category->slug}}</span> </p>
            <input type="hidden" name="slug" id="slug" value="{{$category->slug}}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="form-control-label">Description: </label>
            <textarea name="description" id="editor" class="form-control" rows="10" cols="80">
            {!! $category->description !!}</textarea>
        </div>
    </div>
    <div class="form-group row">
        @php
            $ids = (isset($category->childrens) && ($category->childrens->count() > 0))  ?  Arr::pluck($category->childrens, 'id') : null
        @endphp

        <div class="col-sm-12">
            <label for="form-control-label">Select Category: </label>
            <select name="parent_id[]" id="parent_id"  class="form-control" multiple="multiple">
                <option value="0">Top Level</option>
            @if(isset($categories))
                @foreach($categories as $category)
                    <option value="{{$category['id']}}" @if(!is_null($ids) && in_array($category->id,$ids)) {{'selected'}} @endif>
                    {{$category['title']}}
                    </option>
                @endforeach
            @endif
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <input type="submit" name="submit" class="btn btn-primary" value="Edit Category">
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
    	ClassicEditor.create( document.querySelector( '#editor' ), {
    		toolbar: [ 'Heading', 'Link', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote','undo', 'redo' ],
    	}).then( editor => {
    		console.log( editor );
    	}).catch( error => {
    		console.error( error );
    	});
    	$('#txturl').on('keyup', function(){
    		var url = slugify($(this).val());
    		$('#url').html(url);
    		$('#slug').val(url);
    	});
        $('#parent_id').select2({
                placeholder: "Select a Parent Category",
            	allowClear: true,
            	minimumResultsForSearch: Infinity
        });
    })
</script>
@endsection

