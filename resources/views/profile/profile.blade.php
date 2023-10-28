@extends('layouts.app')
@section('title')
 Profile
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="content-container">
        <div class="page-content">
            <div class="content-header">
                <h1>User Account</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashBoard')}}">Home</a></li>
                    <li class="breadcrumb-item">View</li>
                    <li class="breadcrumb-item">Account</li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-image-section">
                                        <div class="d-flex align-items-center flex-column gap-4">
                                            @if (auth()->user()->image == null)
                                            <img class="img-fluid rounded" src="{{asset('assets/images/user.png')}}" alt="">
                                            @else
                                            <img class="img-fluid rounded" src="{{Storage::url('users/profile_images/' . auth()->user()->image)}}" alt="">
                                            @endif
                                            

                                            <div class="user-info w-100 gap-2 d-flex justify-content-between align-items-center">
                                                <h3 class="mb-2">{{$user->first_name." ".$user->last_name}}</h3>
                                                <span class="badge bg-light-secondary fw-bold text-uppercase">
                                                    @if($user->role==1)
                                                    Admin
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="info-container">
                                        <h5 class="mb-4">Details</h5>
                                        <ul class="list-unstyled">
                                            <li class="mb-3">
                                              <span class="fw-bold me-2">Email:</span>
                                              <span>{{$user->email}}</span>
                                            </li>
                                            <li class="mb-3">
                                              <span class="fw-bold me-2">Phone:</span>
                                              <span>{{$user->phone}}</span>
                                            </li>
                                            <li class="mb-3">
                                              <span class="fw-bold me-2">Status:</span>
                                              <span class="badge bg-light-success text-uppercase fw-bold">
                                                @if($user->status)
                                                Active
                                                @endif
                                              </span>
                                            </li>
                                            <li class="mb-3">
                                              <span class="fw-bold me-2">Address:</span>
                                              <span>{{$user->address}}</span>
                                            </li>
                                            {{-- <li class="mb-3">
                                              <span class="fw-bold me-2">Dob:</span>
                                              <span>{{$user->date_of_birth}}</span>
                                            </li> --}}
                                            {{-- <li class="mb-3">
                                              <span class="fw-bold me-2">Gender:</span>
                                              <span>@if ($user->gender=='MALE')
                                                Male
                                               @else
                                               Female    
                                              @endif</span>
                                            </li> --}}
                                            <li class="mb-3">
                                              <span class="fw-bold me-2">City:</span>
                                              <span>{{$user->city}}</span>
                                            </li>
                                            <li class="mb-3">
                                              <span class="fw-bold me-2">Country:</span>
                                              <span>{{$user->country}}</span>
                                            </li>
                                          </ul>
                                          <div class="d-flex justify-content-center pt-3 border-top">
                                            <a href="{{route('editProfile')}}" class="btn btn-primary me-3"><i data-feather="edit"></i> Edit</a>
                                           
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                            <!-- { User Pills Start } -->
                           
                            <!-- { User Pills End } -->
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5 class="mb-0">Notification</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="UserProjects">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th> </th>
                                                   
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex justify-content-left align-items-center">
                                                            <i data-feather="bell"></i>
                                                            <div class="ms-3 d-flex flex-column">
                                                                <span class="fw-semibold text-truncate">Hello</span>
                                                                <span class="text-muted">First Notification</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                       9:345
                                                    </td>
                                                    <td>
                                                        <i data-feather="x"></i>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection