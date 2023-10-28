@extends('layouts.app')
@section('title')
 Add Picnics
@endsection

@section('styles')
<link rel="stylesheet" href="{{asset('assets/daterangepicker/daterangepicker.css')}}">
@endsection

@section('content')

<!-- [ Main Content ] start -->
<div class="page-content-wrapper">
    <div class="content-container">
        <div class="page-content">
            <div class="content-header">
                <h1>Add Picnic</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashBoard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('picnic')}}">Picnic</a></li>
                    <li class="breadcrumb-item">Add</li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- { Multi Column Forms } start -->
                     <div class="row">
                        <div class="col-12">

                            <div class="card">

                                <div class="card-body">
                                    <form id="picnic_form" method="post">
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label class="form-label"> Title:</label>
                                                <input type="text" name="title" class="form-control"  placeholder="Enter picnic title">

                                            </div>
                                            <div class="col-lg-4">
                                                <label  class="form-label">Location:</label>
                                                <input type="text" name="location" class="form-control" placeholder="Enter location">

                                            </div>
                                            <div class="col-lg-4">
                                                <label  class="form-label">Date: </label>
                                                <div class="input-group date-wrap">
                                                    <div class="input-group-append">
                                                      <span class="input-group-text" id="basic-addon1"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="date" id="date" aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <div class="col-lg-4">
                                                <label  class="form-label">Description:</label>
                                                <textarea class="form-control" name="description" placeholder="Description"></textarea>

                                            </div>
                                            <div class="col-lg-4">
                                                <label  class="form-label">Agenda:</label>
                                                <input type="text" name="agenda" class="form-control"  placeholder="Enter agenda">
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="form-label">Picnic image:</label>
                                                <input type="file" name="image" class="form-control">

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                        <button type="submit" id="add-pinic-submit" class="btn btn-primary me-3">Save</button>
                                        </div>
                                        <input type="hidden" name="id" id="id">
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
  <script>
    var page = "addPage";
    var id = 0;
    var date = "";
    var saveUrl = "{{route('savePicnic')}}";
  </script>
  <script src="{{ asset('assets/daterangepicker/daterangepicker.js')}}"></script>
  <script src="{{asset('assets/web/js/picnic.js')}}"></script>
@endsection
