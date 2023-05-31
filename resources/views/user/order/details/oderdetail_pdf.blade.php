<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        body {
            font-family: "dejavu sans", serif;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                    {{__("messages.Orderdetails")}}
                  <small class="float-right">Date: @php echo date("d/m/Y");@endphp</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                <div class="">
                    <b>{{__("messages.name")}}:</b> {{$order->customer->full_name}}<br>
                    <b>{{__("messages.Address")}}:</b> {{$order->customer->address}}<br>
                    <b>{{__("messages.phone")}}:</b> {{$order->customer->phone}}<br>
                    <b>{{__("messages.email")}}:</b> {{$order->customer->email}}<br>
                  </div>
              </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>{{__("messages.product Name")}}</th>
                    <th>{{__("messages.Amount")}}</th>
                    <th>{{__("messages.Price")}}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($orderdetails as $orderdetail )
                    <tr>
                        <th>{{optional($orderdetail -> product)->name}}</th>
                        <th>{{$orderdetail->quantity}}</th>
                        <th>{{number_format($orderdetail->price)}}</th>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-6">
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th>{{__("messages.Total")}}</th>
                      <td>{{number_format($order->total)}} VND</td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>

            <div class="row no-print">
              <div class="col-12">
              </div>
            </div>
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
        </div>
</body>
</html>
