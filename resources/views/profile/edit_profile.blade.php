@extends('layouts.app')
@section('title')
 Edit
@endsection

@section('content')
<!-- [ Main Content ] start -->
<div class="page-content-wrapper">
    <div class="content-container">
        <div class="page-content">
            <div class="content-header">
                <h1>Edit Profile</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashBoard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('profile')}}">Profile</a></li>
                    <li class="breadcrumb-item">Edit</li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- { Multi Column Forms } start -->
                     <div class="row">
                        <div class="col-12">
                           

                            <div class="card">
                              
                                <div class="card-body">
                                    <form id="edit-profile-form"> 
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label class="form-label"> First Name:</label>
                                                <input type="text" name="first_name" required class="form-control" value="{{$user->first_name}}" placeholder="Enter first name">
                                                <small class="form-text text-muted">Please enter your First name</small>
                                            </div>
                                            <div class="col-lg-4">
                                                <label  class="form-label">Last Name:</label>
                                                <input type="text" name="last_name" required class="form-control" placeholder="Enter last name" value="{{$user->last_name}}">
                                                <small class="form-text text-muted">Please enter your Last name</small>
                                            </div>
                                            <div class="col-lg-4">
                                                <label  class="form-label">Email:</label>
                                                <input type="email" name="email" required class="form-control" value="{{$user->email}}" placeholder="Enter email">
                                                <small class="form-text text-muted">Please enter your Email</small>
                                            </div>
                                            <div class="col-lg-4">
                                                <label  class="form-label">Phone:</label>
                                                <input type="text" name="phone" class="form-control" value="{{$user->phone}}" placeholder="Enter contact number">
                                                <small class="form-text text-muted">Please enter contact number</small>
                                            </div>
                                            <div class="col-lg-4">
                                                <label  class="form-label">Address:</label>
                                                <input type="text" name="address" class="form-control" value="{{$user->address}}" placeholder="Enter address">
                                                <small class="form-text text-muted">Please enter your Email</small>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row">
                                            {{-- <div class="col-lg-4">
                                                <label  class="form-label">Date Of Birth:</label>
                                                <input type="date" class="form-control" placeholder="Enter contact number">
                                                <small class="form-text text-muted">Please enter your dob</small>
                                            </div> --}}
                                            
                                            <div class="col-lg-4">
                                                <label  class="form-label">City:</label>
                                                <input type="text" name="city" value="{{$user->city}}" class="form-control" placeholder="Enter your city">
                                                <small class="form-text text-muted">Please enter your city</small>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="form-label">Country:</label>
                                                <input type="text" name="country" value="{{$user->country}}" class="form-control" placeholder="Enter your country">
                                                <small class="form-text text-muted">Please enter your county</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label class="form-label">User image:</label>
                                                <input type="file" name="user_image" class="form-control" >
                                                <small class="form-text text-muted">Please upload your image</small>
                                            </div>
                                            {{-- <div class="col-lg-4">
                                                <label  class="form-label">User Type:</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="customRadioInline221" name="customRadioInline1" class="form-check-input" checked>
                                                        <label class="form-check-label" for="customRadioInline221">Administrator</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" id="customRadioInline222" name="customRadioInline1" class="form-check-input">
                                                        <label class="form-check-label" for="customRadioInline222">Author</label>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">Please select User Type</small>
                                            </div> --}}
                                            
                                        </div>
                                        <div class="col-lg-4">
                                        <button type="submit" id="edit-profile-submit" class="btn btn-primary me-3">Save</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Change Password</h4>
                                </div>
                                <div class="card-body">
                                    <form id="change-password-form">
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label class="form-label">Old Password:</label>
                                                <input type="password" name="old_password" class="form-control" placeholder="Enter old password">
                                                <small class="form-text text-muted">Please enter your old password</small>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label class="form-label">New Password:</label>
                                                <input type="password" id="new-password" name="new_password" class="form-control" placeholder="Enter new password">
                                                <small class="form-text text-muted">Please enter your new password</small>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label">Confirm New Password:</label>
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter again">
                                                <small class="form-text text-muted">Please confirm your password</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="submit" id="change-password-submit" class="btn btn-danger me-3">Change Password</button>
                                            </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                     </div>
                    <!-- { Multi Column Forms } end -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('assets/web/js/profile.js')}}"></script>
@endsection