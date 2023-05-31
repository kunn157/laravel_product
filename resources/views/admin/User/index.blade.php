@extends('admin.layouts.dashboad')
@section('content')
<div class="row-tabble" >
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <button type="submit" class="btn btn_click" >
              Tác Vụ
              <i class="fa-solid fa-caret-down"></i>
          </button>
          <button type="submit" class="btn btn_click">
            <i class="fa-solid fa-rotate"></i>
           Làm Mới
          </button>
          <button type="submit" class="btn btn_click">
            <i class="fa-solid fa-filter"></i>
            Tìm Kiếm
          </button>
          <form action="{{route("users.index")}}"class="btn btn_click">
            <input type="search" name="search_users">
            <button><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
      </form>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <div class="input-group-append" >
                  <button class="btn btn_click" >
                  <i class="fa-solid fa-plus"></i>
                  <a  href="{{route('users.create') }}">Thêm mới</a>
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
                <th>Emaiil</th>
                <th>User Name</th>
                <th>BirthDay</th>
                <th>Tác vụ</th>
              </tr>
            </thead>
            <tbody>
               @foreach ( $users as $user )
              <tr>
                <td><input type="checkbox"></td>
                <td>{{$user -> id}}</td>
                <td>{{$user -> email}}</td>
                <td>{{$user -> user_name}}</td>
                <td>{{$user -> birthday}}</td>
                <td>
                 <a class="btn btn_action" href="{{route('users.edit' , $user -> id) }}">Sửa</a>
                  <form class= "form_delete_user" data-route="{{route('users.destroy', $user ->id)}}" method="POST" style="display: inline-block">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn_action"><i class="fa-solid fa-trash-can"></i></button>
                  </form>
                </td>
              </tr>
                 @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        {{$users->links()}}
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
