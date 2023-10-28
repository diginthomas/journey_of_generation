@php
    $current_route = Request::route()->getName();
    // echo $current_route;
@endphp

<!-- { navigation menu } start -->
<aside class="app-sidebar app-light-sidebar">
  <div class="app-navbar-wrapper">
    <div class="brand-link brand-logo">
      <a href="{{route('dashBoard')}}" class="b-brand">
        <!-- ========   change your logo hear   ============ -->
        <img src="{{ asset('assets/images/logo-dark.svg') }}"  alt="" class="logo logo-lg"/>
      </a>
    </div>
    <div class="navbar-content">

      <ul class="app-navbar">

        <li class="nav-item nav-hasmenu  {{in_array($current_route,['dashBoard','profile'])? 'active' : ''}}">
          <a href="{{route('dashBoard')}}" class="nav-link"><span class="nav-icon"><i class="ti ti-layout-2"></i></span><span
              class="nav-text">Dashboard</span><span class="nav-arrow"></span></a>
          <!-- <ul class="nav-submenu">
            <li class="nav-item">
              <a class="nav-link" href="{{route('dashBoard')}}">home</a>
            </li>


          </ul> -->
        </li>

        <li class="nav-item nav-hasmenu">
          <a href="#!" class="nav-link"><span class="nav-icon"><i data-feather="calendar"></i></span><span
              class="nav-text">Quotes</span><span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
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
        <li class="nav-item nav-hasmenu {{in_array($current_route,['picnic', 'addPicnic', 'editPicnic','viewPicnic'])? 'active' : ''}}">
          <a href="#" class="nav-link {{in_array($current_route,['picnic', 'addPicnic', 'editPicnic'])? 'active' : ''}}"><span class="nav-icon"><i data-feather="compass"></i></span><span
              class="nav-text">Picnic</span><span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="nav-submenu ">
            <li class="nav-item ">
              <a class="nav-link " href="{{route('picnic')}}">List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/user-reports.html">Reports</a>
            </li>


          </ul>
        </li>
         <li class="nav-item nav-hasmenu">
          <a href="#!" class="nav-link"><span class="nav-icon"><i data-feather="file-text"></i></span><span
              class="nav-text">Survey</span><span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
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
          <a href="#!" class="nav-link"><span class="nav-icon"><i data-feather="award"></i></span><span
              class="nav-text">Volunteers</span><span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
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
          <a href="#!" class="nav-link"><span class="nav-icon"><i data-feather="user-plus"></i></span><span
              class="nav-text">Assistance</span><span class="nav-arrow"><i data-feather="chevron-right"></i></span></a>
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

      </ul>
    </div>
  </div>
</aside>
<!-- { navigation menu } end -->
