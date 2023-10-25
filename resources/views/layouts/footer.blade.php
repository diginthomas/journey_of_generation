@php
    $current_route = Request::route()->getName();
    // echo $current_route;
@endphp

<!-- Footer -->

<footer class="app-footer">
  <div class="footer-wrapper">
    <div class="py-1">
      <span class="text-muted">&copy; {{\Carbon\Carbon::now()->format('Y')}}, Wedash for a better web.</span>
    </div>
    <div class="py-1">
      <ul class="list-inline m-0">
        <li class="list-inline-item">
          <a class="link-secondary" href="javascript:">About Us</a>
        </li>
        <li class="list-inline-item">
          <a class="link-secondary" href="javascript:">Blog</a>
        </li>
        <li class="list-inline-item">
          <a class="link-secondary" href="javascript:">Library</a>
        </li>
      </ul>
    </div>
  </div>
</footer>
<!-- End of Footer -->

<script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<!-- Apex Chart -->
<script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>



<script>

feather.replace();
$(document).ready(function() {
  var thtoggle = $("#pct-toggler");
  if (thtoggle.length) {
    thtoggle.on("click", function() {
      var themeRoller = $(".theme-roller");
      if (!themeRoller.hasClass("active")) {
        themeRoller.addClass("active");
      } else {
        themeRoller.removeClass("active");
      }
    });
  }

  var themescolors = $(".themes-preference > a");
  themescolors.on("click", function(event) {
    var targetElement = $(event.target);
    if (targetElement.is("span")) {
      targetElement = targetElement.parent();
    }
    var temp = targetElement.attr("data-value");
    $("body").removeClass(function(index, className) {
      return (className.match(new RegExp("\\btheme-\\S+", "g")) || []).join(" ");
    });
    $("body").addClass(temp);
    localStorage.setItem("themePreference", temp); // Save theme preference color to localStorage
  });

  var custthemebg = $("#cust-rtllayout");
  custthemebg.on("click", function() {
    if (custthemebg.prop("checked")) {
      $("html").attr("dir", "rtl");
      $("html").attr("lang", "ar");
      $("#rtl-style-link").attr("href", "assets/css/style-rtl.css");
      localStorage.setItem("rtlLayout", true);
    } else {
      $("html").removeAttr("dir");
      $("html").removeAttr("lang");
      $("#rtl-style-link").removeAttr("href");
      localStorage.setItem("rtlLayout", false);
    }
  });

  var custdarklayout = $("#cust-darklayout");
  custdarklayout.on("click", function() {
    if (custdarklayout.prop("checked")) {
      $(".brand-link > .b-brand > .logo-lg").attr("src", "assets/images/logo.svg");
      $("#main-style-link").attr("href", "assets/css/style-dark.css");
      localStorage.setItem("darkLayout", true);
    } else {
      $(".brand-link > .b-brand > .logo-lg").attr("src", "assets/images/logo-dark.svg");
      $("#main-style-link").attr("href", "assets/css/style.css");
      localStorage.setItem("darkLayout", false);
    }
  });

  function removeClassByPrefix(node, prefix) {
    $(node).removeClass(function(index, className) {
      return (className.match(new RegExp("\\b" + prefix + "\\S+", "g")) || []).join(" ");
    });
  }

  // Load settings from localStorage
  var storedDarkLayout = localStorage.getItem("darkLayout");
  if (storedDarkLayout === "true") {
    custdarklayout.prop("checked", true);
    $(".brand-link > .b-brand > .logo-lg").attr("src", "assets/images/logo.svg");
    $("#main-style-link").attr("href", "assets/css/style-dark.css");
  }

  var storedThemePreference = localStorage.getItem("themePreference");
  if (storedThemePreference) {
    $("body").removeClass(function(index, className) {
      return (className.match(new RegExp("\\btheme-\\S+", "g")) || []).join(" ");
    });
    $("body").addClass(storedThemePreference);
  }

  // Apply RTL layout on page load
  $(window).on('load', function() {
    var storedRtlLayout = localStorage.getItem("rtlLayout");
    if (storedRtlLayout === "true") {
      custthemebg.prop("checked", true);
      $("html").attr("dir", "rtl");
      $("html").attr("lang", "ar");
      $("#rtl-style-link").attr("href", "assets/css/style-rtl.css");
    }
  });
});

</script>

@yield('scripts')
