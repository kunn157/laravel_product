<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/font/fontawesome-free-6.2.1-web/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/admin.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/user.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/product.css')}}">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
        </div>
        @include('admin.layouts.header')
        @include('admin.layouts.siderbar')
        @if (session('success'))
                @php
                  Alert::success(session('success'))
                @endphp

            @elseif (session('error'))
                @php
               Alert::error(session('error'))
                @endphp
            @endif
        @yield('content')
        @include('admin.layouts.footer')
        @include('sweetalert::alert')
        {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> --}}
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{asset('assets/js/app.js')}}"></script>
        <script src="{{asset('assets/js/user.js')}}"></script>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
      $('#province-dd').change(function(event) {
          var idCountry = this.value;
          $('#district-dd').html('');

          $.ajax({
          url: "/admin/fetch-district",
          type: 'POST',
          dataType: 'json',
          data: {province_id: idCountry,_token:"{{ csrf_token() }}"},
          success:function(response){
              $('#district-dd').html('<option value="">Select Dictrist</option>');
              $.each(response.districts,function(index, val){
              $('#district-dd').append('<option value="'+val.id+'"> '+val.name+' </option>')
              });
              $('#commune-dd').html('<option value="">Select Commune</option>');
          }
          })
      });
      $('#district-dd').change(function(event) {
          var idState = this.value;
          $('#commune-dd').html('');
          $.ajax({
          url: "/admin/fetch-commune",
          type: 'POST',
          dataType: 'json',
          data: {district_id: idState,_token:"{{ csrf_token() }}"},
          success:function(response){
              $('#commune-dd').html('<option value="">Select Commune</option>');
              $.each(response.communes,function(index, val){
              $('#commune-dd').append('<option value="'+val.id+'"> '+val.name+' </option>')
              });
          }
          })
      });
      });
    </script>
</html>
