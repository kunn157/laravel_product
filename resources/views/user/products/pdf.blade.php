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
    <div style="text-align: center" >
        <h1>List Product</h1>
    @php
        echo date("Y/m/d");
    @endphp
    </div>
    <table class="table table-head-fixed text-nowrap" style="margin-left: auto;margin-right: auto;">
        <thead>
          <tr>
            <th>ID</th>
            <th>{{__("messages.name")}}</th>
            <th>{{__("messages.stock")}}</th>
            <th>{{__("messages.expired_at")}}</th>
            <th>{{__("messages.sku")}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ( $products as $product)
          <tr>
            <td>{{$product -> id}}</td>
            <td>{{$product -> name}}</td>
            <td>{{$product -> stock}}</td>
            <td>{{$product -> expired_at}}</td>
            <td>{{$product -> sku}}</td>
            </tr>
             @endforeach
        </tbody>
      </table>

</body>
</html>
