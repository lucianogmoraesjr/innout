<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/icofont/icofont.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/template.css') }}">
  <title>In N' Out</title>
</head>

<body>
  @include('templates.header')
  @include('templates.sidebar')
  @yield('content')
  @include('templates.footer')

  <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
