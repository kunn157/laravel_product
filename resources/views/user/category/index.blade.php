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
          <button type="submit" class="btn btn_click">
            <i class="fa-solid fa-rotate"></i>
            {{__("messages.refresh")}}
          </button>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <div class="input-group-append" >
                  <button class="btn btn_click" >
                  <i class="fa-solid fa-plus"></i>
                  <a  href="{{route('category.create')}}">{{__("messages.add_new")}}</a>
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
                <th>{{__("messages.category_id")}}</th>
                <th>{{__("messages.action")}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $categories as $category)
              <tr>
                <td><input type="checkbox"></td>
                <td>{{$category -> id}}</td>
                <td>{{$category -> name}}</td>
                <td>{{optional($category -> parentCategory)->name}}</td>
                <td>
                    <a class="btn btn_action" href="{{route('category.edit', $category -> id)}}">{{__("messages.update")}}</a>
                 <form class = "form_delete_category" data-route="{{route('category.destroy', $category ->id)}}" method="POST" style="display: inline-block">
                    <button type="submit" class="btn btn_action" style="background-color: #cf0a0a"><i class="fa-solid fa-trash-can"></i></button>
                    @csrf
                    @method('delete')
                  </form>
                </tr>
                 @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      {{$categories->links()}}
      <!-- /.card -->
    </div>
  </div>
@endsection
