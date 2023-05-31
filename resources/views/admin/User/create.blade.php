@extends('admin.layouts.dashboad')
@section('content')
<div class="card card-primary-form">
    <div class="card-header">
      <h3 class="card-title">Create Users</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror"  id="exampleInputEmail1" name="email" placeholder="Enter email">
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">User Name</label>
          <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="exampleInputPassword1" name="user_name" placeholder="User Name">
          @error('user_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">BirthDay</label>
            <input type="date" name="birthday" class="form-control @error('birthday') is-invalid @enderror" >
            @error('birthday')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Firt Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="exampleInputPassword1" placeholder="First Name">
            @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Last Name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="exampleInputPassword1" placeholder="Last Name">
            @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Status</label>
            <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" id="exampleInputPassword1" placeholder="Status">
            @error('status')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
            <div class="row1" style="display: flex; width: 610px">
                <div class="col-sm-6">
                  <!-- select -->
                  <div class="form-group">
                    <label>Thành Phố</label>
                    <select class="form-control @error('province_id') is-invalid @enderror"  id="province-dd"  name="province_id">
                        <option value="">Select Country</option>
                        @foreach ($provinces as $province)
                        <option value='{{$province-> id}}' >{{$province -> name}}</option>
                        @endforeach
                    </select>
                    @error('province_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>
                </div>
                <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Huyện</label>
                      <select class="form-control @error('district_id') is-invalid @enderror" id="district-dd" name="district_id">
                      </select>
                      @error('district_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Xã</label>
                      <select class="form-control @error('commune_id') is-invalid @enderror" id="commune-dd" name="commune_id">
                      </select>
                      @error('commune_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Address</label>
                <input type="text" class="form-control @error('status') is-invalid @enderror" name="address" id="exampleInputPassword1" placeholder="Address">
                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Avatar</label>
            <input type="file" onchange="readURL(this);"  class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="exampleInputPassword1" placeholder="Status">
            <img id="ImdID" src="{{asset('assets/img/no-img.png')}}" alt="Image" style="max-width: 180px; padding-top:20px" />
            @error('avatar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name= "password"id="exampleInputPassword1" placeholder="Password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
