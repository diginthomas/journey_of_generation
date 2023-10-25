<!DOCTYPE html>
<html lang="en">

  @include('layouts.header')


  <body class="theme-1">
    <!-- { Pre-loader } start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>


    @include('layouts.sidemenu')

    <div id="content">
        @include('layouts.topbar')

        @yield('content')

    </div>
    @include('layouts.footer')

  </body>

</html>
