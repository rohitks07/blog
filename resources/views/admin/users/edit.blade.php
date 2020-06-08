@extends('admin.app')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.profile.index')}}">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit User</a></li>
@endsection
@section('content')
        <h2 class="modal-title">Edit Users</h2>
<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                <div class="col-lg-6">
                    <label class="form-control-label">Name: </label>
                    <input type="text" id="txturl" name="name" class="form-control" value="">&nbsp;
                    <!-- <p class="small">
                        {{config('app.url')}}<span id="url"></span>
                        <input type="hidden" name="slug" id="slug" value="" />
                    </p> -->
                    @if ($errors->has('name'))
                        @foreach($errors->get('name') as $error)
                        <p class="alert alert-danger" style="text-align:center;">
                            <strong>{{ $error }}</strong>
                        </p>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="form-control-label">Email: </label>
                    <input type="text" id="email" name="email" class="form-control" value="">&nbsp;
                    @if ($errors->has('email'))
                        @foreach($errors->get('email') as $error)
                        <p class="alert alert-danger" style="text-align:center;">
                            <strong >{{ $error }}</strong>
                        </p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label class="form-control-label">Password: </label>
                    <input type="password" id="password" name="password" class="form-control" value="">&nbsp;
                    @if ($errors->has('password'))
                        @foreach($errors->get('password') as $error)
                        <p class="alert alert-danger" style="text-align:center;">
                            <strong >{{ $error }}</strong>
                        </p>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="form-control-label">Re-Type Password: </label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" value="">&nbsp;
                    @if ($errors->has('confirm_password'))
                        @foreach($errors->get('confirm_password') as $error)
                        <p class="alert alert-danger" style="text-align:center;">
                            <strong >{{ $error }}</strong>
                        </p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="form-control-label">Status: </label>
                    <div class="input-group">
                        <select class="form-control" id="status" name="status">
                            <option value="0">Blocked</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                        @if ($errors->has('status'))
                            @foreach($errors->get('status') as $error)
                            <p class="alert alert-danger" style="text-align:center;">
                                <strong>{{ $error }}</strong>
                            </p>
                            @endforeach
                        @endif
                </div>
                <div class="col-md-6">
                    <label class="form-control-label">Select Role: </label>
                    <div class="input-group">
                        <select class="form-control" id="role" name="role_id">
                        @if($roles->count() > 0)
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label class="form-control-label">Country: </label>
                    <div class="input-group">
                        <select class="form-control" id="country" name="country_id">
                            <option value="0">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-control-label">State: </label>
                    <div class="input-group">
                        <select class="form-control" id="state" name="state_id">
                            <option value="0">Select State</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-control-label">City: </label>
                    <div class="input-group">
                        <select class="form-control" id="city" name="city_id">
                            <option value="0">Select City</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="form-control-label">Address: </label>
                    <input type="text" id="" name="address" class="form-control" value="">
                </div>
                <div class="col-md-6">
                    <label class="form-control-label">Phone: </label>
                    <div class="input-group">
                        <input type="text" name="phone"  class="form-control">
                    </div>&nbsp;
                    @if ($errors->has('phone'))
                            @foreach($errors->get('phone') as $error)
                            <p class="alert alert-danger" style="text-align:center;">
                                <strong>{{ $error }}</strong>
                            </p>
                            @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <ul class="list-group row">
                <li class="list-group-item active"><h5>Profile Image</h5></li>
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
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Add User">
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // $("#txturl").on("keyup", function () {
        //     const pretty_url = slugify($(this).val());
        //     $("#url").html(slugify(pretty_url));
        //     $("#slug").val(pretty_url);
        // });

        //images change
        $("#thumbnail").on("change", function () {
            var file = $(this).get(0).files;
            var reader = new FileReader();
            reader.readAsDataURL(file[0]);
            reader.addEventListener("load", function (e) {
                var image = e.target.result;
                $("#imgthumbnail").attr("src", image);
            });
        });


        // Select contury based on state
        $('#country').on('change',function(){
            var countryID = $(this).val();
            $("#state").html('<option value="0">--Select--</option>');
            $("#city").html('<option value="0">--Select--</option>');
            if(countryID)
            {
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'GET',
                    url:"{{route('admin.profile.states')}}/" + countryID,
                    contentType:'application/json',
                    dataType:"json",
                    success:function(data){
                        // console.log(data);
                        $("#state").html('<option value="0">--Select--</option>');
                        for(var i=0;i<data.length;i++){
                            $("#state").append('<option value="'+data[i].id+'" >'+data[i].name+'</option>');
                        }
                    }
                });
            }else{
                $('#state').html('<option value="0">Select Country first</option>');
                $('#city').html('<option value="0">Select State first</option>');
            }
        });

        // Select state based on city
        $('#state').on('change',function(){
            var stateID = $(this).val();
            if(stateID){
                $.ajax({
                    type:'GET',
                    url:"{{route('admin.profile.cities')}}/" + stateID,
                    contentType:'application/json',
                    dataType:"json",
                    success:function(data){
                        $("#city").html('<option value="0">--Select--</option>');
                        for(var i=0;i<data.length;i++){
                            $("#city").append('<option value="'+data[i].id+'" >'+data[i].name+'</option>');
                        }
                    }
                });
            }else{
                $('#city').html('<option value="0">Select State first</option>');
            }
        });
    });
</script>
@endsection
