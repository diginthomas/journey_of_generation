<head>

  <meta charset="utf-8" />
  <meta  name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Dashboard Template Description" />
  <meta name="keywords" content="Dashboard Template" />
  <meta name="author" content="Techne infosys" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />


  <title>@yield('title')</title>

  <link rel="icon" href=" {{ asset('assets/images/favicon.svg') }}" type="image/x-icon" />

  <!-- font css -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">


  <!-- vendor css -->
  <link rel="stylesheet" href="#" id="rtl-style-link">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

  @yield('styles')

</head>
