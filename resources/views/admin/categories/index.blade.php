@extends('admin.app')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Categories</a></li>
@endsection
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Categories List</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{route('admin.category.create')}}" class="btn btn-sm btn-outline-secondary">Add Category </a>
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
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>Categories</th>
                    @if($create == 0)
                        <th>Created Date</th>
                    @elseif($create == 1)
                        <th>Deleted Date</th>
                    @endif
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(($categories->count() > 0))
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{ucfirst($category->title)}}</td>
                            <td>{!! $category->description !!}</td>
                            <td>{{$category->slug}}</td>
                            <td>
                                @if($category->childrens()->count() > 0 )
                                    @foreach($category->childrens as $children)
                                        {{$children['title']}},
                                    @endforeach
                                @else
                                    <strong>Parent Category</strong>
                                @endif
                            </td>
                            @if($category->trashed())
                            <td>{{date('d/m/Y ', strtotime(@$category->deleted_at)) }}</td>
                                <td><a class="btn btn-success btn-sm" href="{{route('admin.category.recover',$category->id)}}">Restore</a> |
                                    <a class="btn btn-danger btn-sm" onclick="deleteRecord('{{$category->id}}')">Delete</a>
                                    <form id="delete-record-{{$category->id}}" action="{{ route('admin.category.destroy',$category->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            @else
                                <td>{{date('d/m/Y ', strtotime(@$category->created_at)) }}</td>
                                <td><a class="btn btn-info btn-sm" href="{{route('admin.category.edit',$category->id)}}">Edit</a> |
                                    <a class="btn btn-warning btn-sm" href="{{route('admin.category.remove',$category->id)}}">Trash</a> |
                                    <a class="btn btn-danger btn-sm" onclick="deleteRecord('{{$category->id}}')">Delete</a>
                                    <form id="delete-record-{{$category->id}}" action="{{ route('admin.category.destroy',$category->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="7" class="" style="color:red;text-align:center;">No Categories Found.....</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{$categories->links()}}
        </div>
    </div>
@endsection
@section('scripts')
<script>
    function deleteRecord(id){
        let  choice = confirm("Are you sure want to delete the record Pamanently?");
        if(choice){
            document.getElementById('delete-record-'+id).submit();
        }
    }
</script>

@endsection

