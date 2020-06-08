@extends('admin.app')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">User</a></li>
@endsection
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Users List</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{route('admin.profile.create')}}" class="btn btn-sm btn-outline-secondary">Add User </a>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Address</th>
                    <th>Thumbnail</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($users->count() > 0)
                    @php $count=1; @endphp
                    @foreach($users as $user)
                        <tr>
                            <td>{{$count++}}</td>
                            {{-- <td>{{$user->id}}</td> --}}
                            <td>{{ucfirst($user->profile->name)}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role->name}}</td>
                            <td>{{$user->profile->address}}@if(@$user->getCity()),{{@$user->getCity()}} @endif @if(@$user->getState()),{{@$user->getState()}}@endif @if(@$user->getCountry()),{{@$user->getCountry()}}@endif</td>
                            <td><img src="{{url('')}}/{{$user->profile->thumbnail}}"  class="img-responsive" height="50" width="70"/></td>
                            @if($user->trashed())
                                <td>{{date('d/m/Y ', strtotime($user->deleted_at)) }}</td>
                                <td><a class="btn btn-success btn-sm" href="{{route('admin.product.recover',$user->id)}}">Restore</a> |
                                    <a class="btn btn-danger btn-sm" onclick="deleteRecord('{{$user->id}}')">Delete</a>
                                    <form id="delete-{{$product->id}}" action="{{ route('admin.product.destroy',$user->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            @else
                                <td>{{date('d/m/Y ', strtotime($user->created_at)) }}</td>
                                <td><a class="btn btn-info btn-sm" href="{{route('admin.profile.edit',$user->id)}}">Edit</a> |
                                    <a class="btn btn-warning btn-sm" href="{{route('admin.product.remove',$user->id)}}">Trash</a> |
                                    <a class="btn btn-danger btn-sm" onclick="deleteRecord('{{$user->id}}')">Delete</a>
                                    <form id="delete-{{$user->id}}" action="{{ route('admin.profile.destroy',$user->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="8" class="" style="color:red;text-align:center;">No User Found.....</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{  $users->links() }}
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

