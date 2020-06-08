@extends('admin.app')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Products</a></li>
@endsection
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Products List</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{route('admin.product.create')}}" class="btn btn-sm btn-outline-secondary">Add Product </a>
    </div>
</div>
    <div class="form-group-row">
        <div class="col-sm-12" style="text-align:center;">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message')}}
                </div>
            @endif
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>Categories</th>
                    <th>Price</th>
                    <th>Thumbnail</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($products->count() > 0)
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{ucfirst($product->title)}}</td>
                            <td>{!! $product->description !!}</td>
                            <td>{{$product->slug}}</td>
                            <td>
                                @if($product->catagories()->count() > 0 )
                                    @foreach($product->catagories as $catagory)
                                        {{$catagory['title']}},
                                    @endforeach
                                @else
                                    <strong>Product</strong>
                                @endif
                            </td>
                            <td>${{$product->price}}</td>
                            <td><img src="{{url('')}}/{{$product->thumbnail}}" alt="{{$product->title}}" class="img-responsive" height="50" width="70"/></td>
                            @if($product->trashed())
                                <td>{{date('d/m/Y ', strtotime($product->deleted_at)) }}</td>
                                <td><a class="btn btn-success btn-sm" href="{{route('admin.product.recover',$product->id)}}">Restore</a> |
                                    <a class="btn btn-danger btn-sm" onclick="deleteRecord('{{$product->id}}')">Delete</a>
                                    <form id="delete-{{$product->id}}" action="{{ route('admin.product.destroy',$product->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            @else
                                <td>{{date('d/m/Y ', strtotime($product->created_at)) }}</td>
                                <td><a class="btn btn-info btn-sm" href="{{route('admin.product.edit',$product->id)}}">Edit</a> |
                                    <a class="btn btn-warning btn-sm" href="{{route('admin.product.remove',$product->id)}}">Trash</a> |
                                    <a class="btn btn-danger btn-sm" onclick="deleteRecord('{{$product->id}}')">Delete</a>
                                    <form id="delete-{{$product->id}}" action="{{ route('admin.product.destroy',$product->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="9" class="" style="color:red;text-align:center;">No Product Found.....</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{$products->links()}}
        </div>
    </div>
@endsection
@section('scripts')
<script>
    function deleteRecord(id){
        // alert(id)
        let  choice = confirm("Are you sure want to delete the record Pamanently?");
        if(choice){
            document.getElementById('delete-'+id).submit();
        }
    }
</script>
@endsection

