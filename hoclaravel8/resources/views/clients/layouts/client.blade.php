<!DOCTYPE html>
<html lang="en">
<head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <meta http-equiv="X-UA-Compatible" content="ie=edge">
              <title>@yield('title') - Unicode</title>
              <link rel="stylesheet"  href="{{ asset('clients/css/bootstrap.min.css') }}" />
              <link rel="stylesheet"  href="{{ asset('clients/css/style.css') }}" />
              @yield('css')
</head>
<body>

              @include('clients.blocks.header')

              <script src="{{ asset('clients/js/bootstrap.min.js') }}"></script>
              <script src="{{ asset('clients/js/custom.js') }}"></script>
              @yield('js')
</body>
</html>