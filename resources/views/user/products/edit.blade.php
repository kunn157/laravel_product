@extends('user.layouts.dashboad')
@section('content')
<div class="card card-primary-form">
    <div class="card-header">
      <h3 class="card-title">{{__("messages.editProduct")}}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" action="{{route('products.update', $product -> id)}}" enctype="multipart/form-data" >
        @method('put')
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">{{__("messages.product Name")}}</label>
            <input type="text" class="form-control input_name @error('name') is-invalid @enderror" value="{{old('name',$product->name)}}"  id="exampleInputEmail1" name="name" placeholder="Tên Sản Phẩm">
            @error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">{{__("messages.stock")}}</label>
            <input type="text" class="form-control input_stock @error('stock') is-invalid @enderror" value="{{old('name',$product->stock)}}" id="exampleInputPassword1" name="stock" placeholder="">
            @error('stock')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
              <label for="exampleInputPassword1">{{__("messages.expired_at")}}</label>
              <input type="date" name="expired_at"  class="form-control input_expired @error('expired_at') is-invalid @enderror"  value="{{old('name',$product->expired_at)}}">
              @error('expired_at')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">{{__("messages.avatar")}}</label>
                <input type="file" onchange="readURL(this);"  class="form-control @error('avatar') is-invalid @enderror" name="avatar"   placeholder="">
                <img id="ImdID" class ="avatar" src="{{asset('storage/'.$product->avatar)}}"  alt="Image"  />
                @error('avatar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label for="exampleInputPassword1">{{__("messages.sku")}}</label>
                  <input type="text" class="form-control input_sku @error('sku') is-invalid @enderror" value="{{old('name',$product->sku)}}" name="sku" id="exampleInputPassword1" placeholder="">
                  @error('sku')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                </div>
                <div class="form-group">
                    <div class="form-group">
                      <label for="exampleInputPassword1">{{__("messages.price")}}</label>
                      <input type="text" class="form-control input_sku @error('sku') is-invalid @enderror" value="{{old('name',$product->price)}}" name="price" id="exampleInputPassword1" placeholder="">
                      @error('sku')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    </div>
              </div>
              <div class="form-group">
                  <div class="form-group">
                      <select class="form-control input_category @error('category_id') is-invalid @enderror" name="category_id">
                          <option value="">{{__("messages.not available")}} </option>
                         @foreach ($categories as $category)
                         <option value='{{$category -> id}}' >{{$category -> name}}</option>
                         @endforeach
                      </select>
                      @error('category_id')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{__("messages.submit")}}</button>
                <button type="button" class="btn btn-primary" onclick="OpenProduct();">{{__("messages.preview")}}</button>
              </div>
            </div>
            <div>
                <div class="productview" id="productview">
                    <div class="left">
                     <div>
                         <span>{{__("messages.name")}}</span>
                         <span class="show_name"></span>
                     </div>
                     <div>
                        <span>{{__("messages.stock")}}</span>
                        <span class="show_stock"></span>
                    </div>
                    <div>
                        <span>{{__("messages.expired_at")}}</span>
                        <span class="show_expired"></span>
                    </div>
                     <div>
                         <span>{{__("messages.sku")}}</span>
                         <span class="show_sku"></span>
                     </div>
                     <div>
                        <span>{{__("messages.category_id")}}</span>
                        <span class="show_categery"></span>
                    </div>
                     <button type="button" class="btn btn-primary" onclick="CloseProduct();">{{__("messages.close")}}</button>
                 </div>
                 <img src="{{asset('storage/'.$product->avatar)}}" class="show_img" alt="">
                </div>
            </div>
    </form>
  </div>

@endsection
