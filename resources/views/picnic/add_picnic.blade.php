@extends('layouts.app')
@section('title')
 Add Picnics
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
                                    <form id="add-picnic-form">
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label class="form-label"> Title:</label>
                                                <input type="text" name="title" required class="form-control"  placeholder="Enter picnic title">

                                            </div>
                                            <div class="col-lg-4">
                                                <label  class="form-label">Location:</label>
                                                <input type="text" name="location" required class="form-control" placeholder="Enter location" ">

                                            </div>
                                            <div class="col-lg-4">
                                                <label  class="form-label">Date:</label>
                                                <input type="date" name="date" required class="form-control"  >

                                            </div>
                                           

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label  class="form-label">Time:</label>
                                                <input type="text" name="time" class="form-control" " placeholder="Enter time">

                                            </div>
                                            <div class="col-lg-4">
                                                <label  class="form-label">Description:</label>
                                                <textarea class="form-control"></textarea>

                                            </div>
                                            <div class="col-lg-4">
                                                <label  class="form-label">Agenda:</label>
                                                <input type="text" name="agenda" class="form-control" " placeholder="Enter agenda">

                                            </div>
                                            
                                        </div>
                                      
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label class="form-label">Picnic image:</label>
                                                <input type="file" name="image" class="form-control">

                                            </div>
                                          

                                        </div>
                                        <div class="col-lg-4">
                                        <button type="submit" id="add-pinic-submit" class="btn btn-primary me-3">Add</button>
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
