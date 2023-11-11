@extends('layouts.app')
@section('title')
 Walk Goals
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('content')


<div class="page-content-wrapper">
    <div class="content-container">
        <div class="page-content">
            <div class="content-header">
                <h1>Walk Goals </h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashBoard')}}">Home</a></li>
                    <li class="breadcrumb-item">Walk Goals</li>

                </ul>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h4>Senior Walk Table </h4><span style="float: right;">  <input type="text" id="date" class="form-control"  name="date" /></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="picnic-list-table">
                                 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    var page = "listPage";
    var listUrl = '{{route('walkList')}}';
    // var deleteUrl = "{{route('deletePicnic')}}";
</script>
<script src="{{ asset('assets/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/web/js/walk.js')}}"></script>
@endsection
