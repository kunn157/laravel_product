@extends('user.layouts.dashboad')
@section('content')
<div class="row-tabble" >
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <button type="submit" class="btn btn_click" >
            {{__("messages.action")}}
              <i class="fa-solid fa-caret-down"></i>
          </button>
          <a type="submit" class="btn btn_click" href={{route('products.index')}} >
            <i class="fa-solid fa-rotate"></i>
            {{__("messages.refresh")}}
          </a>
          <a type="submit" style="background-color:#0bb357" href={{route('products.pdf')}} class="btn btn_click">
            <i class="fa-solid fa-download"></i>
            PDF
          </a>
          <a type="submit" style="background-color:#c714b8" href={{route('products.csv')}} class="btn btn_click">
            <i class="fa-solid fa-download"></i>
            CSV
          </a>
          <form action="{{route("products.index")}}"class="btn btn_click">
                <input type="search" name="search_product" placeholder="{{__("messages.search")}}">
                <select name="select_stock" id="">
                    <option value="">{{__("messages.options_value")}}</option>
                    <option value="1">{{__("messages.options_value_1")}}</option>
                    <option value="2">{{__("messages.options_value_2")}}</option>
                    <option value="3">{{__("messages.options_value_3")}}</option>
                    <option value="4">{{__("messages.options_value_4")}}</option>
                </select>
                <button><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
          </form>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <div class="input-group-append" >
                  <button class="btn btn_click" >
                  <i class="fa-solid fa-plus"></i>
                  <a  href={{route('products.create')}}>{{__("messages.add_new")}}</a>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th><input type="checkbox"></th>
                <th>ID</th>
                <th>{{__("messages.name")}}</th>
                <th>{{__("messages.stock")}}</th>
                <th>{{__("messages.expired_at")}}</th>
                <th>{{__("messages.avatar")}}</th>
                <th>{{__("messages.sku")}}</th>
                <th>{{__("messages.category_id")}}</th>
                <th>{{__("messages.action")}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $products as $product)
              <tr>
                <td><input type="checkbox"></td>
                <td>{{$product -> id}}</td>
                <td>{{$product -> name}}</td>
                <td>{{$product -> stock}}</td>
                <td>{{$product -> expired_at}}</td>
                <td><img src="{{asset('storage/'.$product->avatar)}}" style="width:50px;height:50px"></td>
                <td>{{$product -> sku}}</td>
                <td>{{$product -> category->name}}</td>
                <td>
                    <a class="btn btn_action" href="{{route('products.edit', $product -> id)}}">{{__("messages.update")}}</a>
                    {{-- class = "form_delete" data-route --}}
                    <form class = "form_delete_product" data-route="{{route('products.destroy', $product -> id)}}"  method="POST" style="display: inline-block">
                        @method('delete')
                        <button type="submit" class="btn btn_action"  style="background-color: #cf0a0a"><i class="fa-solid fa-trash-can"></i> </button>
                        @csrf
                    </form>
                </tr>
                 @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
