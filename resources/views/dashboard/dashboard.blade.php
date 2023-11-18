
@extends('layouts.app')
@section('title')
 Dashboard
@endsection

@section('content')
<!-- [ Main Content ] start -->

    <div class="content-container">
        <div class="page-content">
            <div class="content-header">
                <h1 class="mb-0">Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body bg-primary rounded-3">
                                    <div class="row">
                                      <div class="col-lg-12 col-md-12 col-12">
                                        <div class="d-lg-flex justify-content-between align-items-center ">
                                          <div class="d-md-flex align-items-center">
                                            @if($user->image != null)
                                              <img src="{{Storage::url('users/profile_images/' . $user->image)}}">
                                            @else
                                              <img src="{{asset('assets/images/user/avatar-1.jpg')}}" alt="Image" class="rounded-circle avatar avatar-xl">
                                            @endif
                                            <div class="ms-md-4 mt-3">
                                              <h2 class="text-white fw-600 mb-1">Good afternoon, <br> Techne Infosys</h2>
                                              <p class="text-white"> Here is what’s happening with your projects today:</p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body rounded border border-success bg-light-success">
                                    <div class="d-flex align-items-center">
                                        <div class="numbers flex-grow-1 pe-3">
                                            <p class="fw-600 mb-1 text-muted">Today's Money</p>
                                            <h4 class="fw-700 mb-0 text-dark-black">$53,000 <span
                                                    class="text-success text-sm fw-700">+55%</span></h4>
                                        </div>
                                        <div class="icon-shape bg-success ">
                                            <i class="ti ti-report-money"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body rounded border border-success bg-light-success">
                                    <div class="d-flex align-items-center">
                                        <div class="numbers flex-grow-1 pe-3">
                                            <p class="fw-600 mb-1 text-muted">Today's Users</p>
                                            <h4 class="fw-700 mb-0 text-dark-black">2,300 <span
                                                    class="text-success text-sm fw-700">+3%</span></h4>
                                        </div>
                                        <div class="icon-shape bg-success ">
                                            <i class="ti ti-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body  rounded border border-danger bg-light-danger">
                                    <div class="d-flex align-items-center">
                                        <div class="numbers flex-grow-1 pe-3">
                                            <p class="fw-600 mb-1 text-muted">New Clients</p>
                                            <h4 class="fw-700 mb-0 text-dark-black">+3,462 <span
                                                    class="text-danger text-sm fw-700">-2%</span></h4>
                                        </div>
                                        <div class="icon-shape bg-danger ">
                                            <i class="ti ti-click"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body rounded border border-danger bg-light-danger">
                                    <div class="d-flex align-items-center">
                                        <div class="numbers flex-grow-1">
                                            <p class="fw-600 mb-1 text-muted">Sales</p>
                                            <h4 class="fw-700 mb-0 text-dark-black">$103,430 <span
                                                    class="text-danger text-sm fw-700">+5%</span></h4>
                                        </div>
                                        <div class="icon-shape bg-danger ">
                                            <i class="ti ti-shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card table-card">
                          <figure class="highcharts-figure">
                            <div id="chart-data">
                              <!-- Data from dashboard.js file -->
                            </div>
                          </figure>
                        </div>
                      </div>
                    </div>
                    <div class="row  picnic-table">
                      <!-- Data from dashboard.js file -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


<!-- <div class="theme-roller">
  <div class="open-button">
    <button class="btn btn-primary" id="pct-toggler">
      <i data-feather="settings"></i>
    </button>
  </div>
  <div class="theme-roller-content">
    <div class="presets-header bg-primary">
      <h5 class="mb-0 text-white f-w-400">Theme Customizer</h5>
    </div>
    <div class="presets-list">
      <h6 class="mt-2">
        <i data-feather="credit-card" class="me-2"></i>Primary color settings
      </h6>
      <hr class="my-2" />
      <div class="themes-preference">
        <a href="#!" class="" data-value="theme-1"></a>
        <a href="#!" class="" data-value="theme-2"></a>
        <a href="#!" class="" data-value="theme-3"></a>
        <a href="#!" class="" data-value="theme-4"></a>
      </div>
      <hr class="my-2" />
      <h6 class="mt-4">
        <i data-feather="sun" class="me-2"></i>Layout settings
      </h6>
      <hr class="my-2" />
      <div class="form-check form-switch mt-2">
        <input type="checkbox" class="form-check-input"   id="cust-darklayout" />
        <label class="form-check-label f-w-600 pl-1" for="cust-darklayout" >Dark Layout</label>
      </div>
      <h6 class="mt-4">
        <i data-feather="layout" class="me-2"></i>Right To Left
      </h6>
      <hr class="my-2" />
      <div class="form-check form-switch">
        <input type="checkbox" class="form-check-input"   id="cust-rtllayout"/>
        <label class="form-check-label f-w-600 pl-1" for="cust-rtllayout">RTL layout</label>
      </div>
    </div>
  </div>
</div> -->


@section('scripts')
<script>
  var charURL = "{{ route('getChartData') }}";
  var getPicnicURL = "{{ route('getLatestPicnic') }}";
  var viewPicnicURL = "{{ route('viewPicnic', '') }}";
</script>
<script src="{{asset('assets/web/js/dashboard.js')}}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

@endsection
