@extends('user.layouts.dashboad')
@section('content')
<div class="card card-primary-form">
    <div class="card-header">
      <h3 class="card-title">Edit Category</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" action="{{route('category.update', $category -> id)}}" >
        @method('put')
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputPassword1">Tên sản phẩm</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$category->name)}}" id="exampleInputPassword1" name="name" placeholder="User Name">
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Parent Category</label>
            <select class="form-control" name="parent_id">
                <option value="">Không có </option>
                @if(optional($category -> childCategory)->count()<1 )
                @foreach ($categories as $category)
                <option value='{{$category -> id}}'>{{$category -> name}}</option>
                @endforeach
                @endif
            </select>
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
