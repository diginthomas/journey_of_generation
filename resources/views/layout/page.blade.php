<html lang="en">
<head>
  
    <title> @yield('title')</title>
    @include('layouts.head')
    @include('layout.header')
    @yield('styles')
</head>

     @yield('content')
     @include('layout.footer')
     @yield('scripts')
</body>
</html>
