@extends('admin.layouts.dashboad')
@section('content')
<div class="card card-primary-form">
    <div class="card-header">
      <h3 class="card-title">Edit Users</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" action="{{route('users.update', $user -> id)}}" enctype="multipart/form-data">
      @method('put')
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" value="{{old('email',$user->email)}}" name="email" placeholder="Enter email">
          @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">User Name</label>
          <input type="text" class="form-control  @error('user_name') is-invalid @enderror" id="exampleInputPassword1" value="{{old('email',$user->user_name)}}" name="user_name" placeholder="User Name">
          @error('user_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">BirthDay</label>
            <input type="date" name="birthday" value="{{old('email',$user->birthday)}}" class="form-control  @error('birthday') is-invalid @enderror" >
            @error('birthday')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Firt Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{old('email',$user->first_name)}}" id="exampleInputPassword1" placeholder="First Name">
            @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Last Name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{old('email',$user->last_name)}}"  id="exampleInputPassword1" placeholder="Last Name">
            @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Status</label>
            <input type="text" class="form-control" name="status" value="{{old('email',$user->status)}}"  id="exampleInputPassword1" placeholder="Status">
          </div>
          <div class="row1" style="display: flex; width: 610px">
            <div class="col-sm-6">
                <!-- select -->
                <div class="form-group">
                  <label>Thành Phố</label>
                  <select class="form-control @error('province_id') is-invalid @enderror"  id="province-dd"  name="province_id">
                     @if(!is_null($user->province_id))
                      <option value="">Select Country</option>
                      @foreach ($provinces as $province)
                      <option value="{{ $province->id }}"
                          {{ old('province_id', $user->province_id) == $province->id ? 'selected' : '' }}>
                          {{ $province->name }}
                      </option>
                  @endforeach
                   @endif
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
                    @if(!is_null($user->district_id))
                    <option value="{{old('district_id',$user->district_id)}}">{{$user->district->name}}</option>
                    @endif
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
                    @if(!is_null($user->commune_id))
                    <option value="{{old('commune_id',$user->commune_id)}}">{{$user->commune->name}}</option>
                    @endif
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
            <input type="text" class="form-control @error('status') is-invalid @enderror" name="address" value="{{old('address',$user->address)}}" id="exampleInputPassword1" placeholder="Address">
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
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
@endsection
