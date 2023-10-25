@php
    $current_route = Request::route()->getName();
    // echo $current_route;
@endphp

<!-- { navigation menu } start -->
<aside class="app-sidebar app-light-sidebar">
  <div class="app-navbar-wrapper">
    <div class="brand-link brand-logo">
      <a href="https://dev.techneinfosys.com/html/wedash/index.html" class="b-brand">
        <!-- ========   change your logo hear   ============ -->
        <img src="{{ asset('assets/images/logo-dark.svg') }}"  alt="" class="logo logo-lg"/>
      </a>
    </div>
    <div class="navbar-content">

      <ul class="app-navbar">

        <li class="nav-item nav-hasmenu">
          <a href="#!" class="nav-link"><span class="nav-icon"><i class="ti ti-layout-2"></i></span><span
              class="nav-text">Dashboard</span><span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="nav-submenu">
            <li class="nav-item">
              <a class="nav-link" href="index.html">home</a>
            </li>


          </ul>
        </li>

        <li class="nav-item nav-hasmenu">
          <a href="#!" class="nav-link"><span class="nav-icon"><i class="ti ti-layout-2"></i></span><span
              class="nav-text">Quotes</span><span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="nav-submenu">
            <li class="nav-item">
              <a class="nav-link" href="pages/kanban.html">Kanban</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/calendar.html">Calendar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/analytics.html">Analytics</a>
            </li>
          </ul>
        </li>
        <li class="nav-item nav-hasmenu">
          <a href="#!" class="nav-link"><span class="nav-icon"><i data-feather="user"></i></span><span
              class="nav-text">Picnic</span><span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="nav-submenu">
            <li class="nav-item">
              <a class="nav-link" href="pages/user-list.html">List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/user-reports.html">Reports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/user-team.html">Team</a>
            </li>
            <li class="nav-item nav-hasmenu">
              <a class="nav-link" href="#">View<span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
              <ul class="nav-submenu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/user-account-view.html">Account</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/user-security-view.html">Security</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/user-billing-view.html">Billing & Plans</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/user-notifications-view.html">Notifications</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/user-connections-view.html">Connections</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item nav-hasmenu">
          <a href="#!" class="nav-link"><span class="nav-icon"><i class="ti ti-shopping-cart"></i></span><span
              class="nav-text">Survey</span><span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="nav-submenu">
            <li class="nav-item">
              <a class="nav-link" href="pages/ecommerce-add-new-products.html">New Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/ecommerce-products-details.html">Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/ecommerce-products.html">Product Lists</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/ecommerce-order-list.html">Order Lists</a>
            </li>
          </ul>
        </li>
        <li class="nav-item nav-hasmenu">
          <a href="#!" class="nav-link"><span class="nav-icon"><i class="ti ti-lock"></i></span><span
              class="nav-text">Volunteer</span><span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="nav-submenu">
            <li class="nav-item nav-hasmenu">
              <a class="nav-link" href="#">Variant 1<span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
              <ul class="nav-submenu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/authentication-signin.html" target="_blank">Sign up</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/authentication-login.html" target="_blank">Sign in</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/authentication-lock.html" target="_blank">Lock Screen</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/authentication-verification.html" target="_blank">2-Step Verification</a>
                </li>
              </ul>
            </li>
            <li class="nav-item nav-hasmenu">
              <a class="nav-link" href="#">Variant 2<span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
              <ul class="nav-submenu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/authentication-signin-2.html" target="_blank">Sign up</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/authentication-login-2.html" target="_blank">Sign in</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/authentication-lock-2.html" target="_blank">Lock Screen</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/authentication-verification-2.html" target="_blank">2-Step Verification</a>
                </li>

              </ul>
            </li>
          </ul>

        </li>


        <li class="nav-item nav-hasmenu">
          <a href="#!" class="nav-link"><span class="nav-icon"><i class="ti ti-apps"></i></span><span
              class="nav-text">Assistance</span><span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="nav-submenu">
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-alert.html">Alert</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-buttons.html">Button</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-badges.html">Badges</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-breadcrumb.html">Breadcrumb</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-cards.html">Cards</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-collapse.html">Collapse</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-carousel.html">Carousel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-dropdowns.html">Dropdowns</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-offcanvas.html">Offcanvas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-pagination.html">Pagination</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-progress.html">Progress</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-list-group.html">List group</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-modal.html">Modal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-spinner.html">Spinner</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-tabs.html">Tabs & pills</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-typography.html">Typography</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-tooltip-popover.html">Tooltip & popovers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-toasts.html">Toasts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="elements/basic-utilities.html">Utilities</a>
            </li>
          </ul>
        </li>








      </ul>
    </div>
  </div>
</aside>
<!-- { navigation menu } end -->
