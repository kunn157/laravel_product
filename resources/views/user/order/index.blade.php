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
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>{{__("messages.OrdererName")}}</th>
                <th>{{__("messages.Amount")}}</th>
                <th>{{__("messages.Price")}}</th>
                <th>{{__("messages.action")}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $orders as $order)
              <tr>
                <td>{{optional($order ->customer)->full_name}}</td>
                <td>{{$order ->quantity }}</td>
                <td>{{number_format($order->total)}}</td>
                <td><a class="btn btn_action" href="{{route('order.show', $order -> id)}}"><i class="fa-solid fa-eye"></i></a></td>
                @endforeach
                </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
