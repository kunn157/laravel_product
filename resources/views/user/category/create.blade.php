@extends('user.layouts.dashboad')
@section('content')
<div class="card card-primary-form">
    <div class="card-header">
      <h3 class="card-title">{{__("messages.createCategory")}}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" action="{{route('category.store')}}" >
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputPassword1">{{__("messages.nameCategory")}}</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputPassword1" name="name" placeholder="{{__("messages.nameCategory")}}">
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">{{__("messages.parentCategory")}}</label>
            <select class="form-control" name="parent_id">
                <option value="">{{__("messages.not available")}} </option>
               @foreach ($categories as $category)
               <option value='{{$category -> id}}' >{{$category -> name}}</option>
               @endforeach
            </select>
          </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>

@endsection
