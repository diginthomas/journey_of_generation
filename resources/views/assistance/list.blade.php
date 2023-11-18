@extends('layouts.app')
@section('title')
 Assistance 
@endsection
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
     .centered-div {   
           padding-left: 40%;
           padding-right: 40%;
           text-align: center;    
        }
    </style>
@endsection

@section('content')


<div class="page-content-wrapper">
    <div class="content-container">
        <div class="page-content">
            <div class="content-header">
                <h1>Assistance </h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashBoard')}}">Home</a></li>
                    <li class="breadcrumb-item">Assistance List</li>

                </ul>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h4>Senior Table </h4>
                            <div class="centered-div">
                                <select class="status-filter" name="status" style="width: 100%">
                                    <option value="">Select all status </option>
                                    <option value="2">Approved</option>
                                    <option value="1" selected>Pending</option>
                                    <option value="3">Rejected</option>
                                  </select>
                                </div>
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
    var listUrl = '{{route('assistanceList')}}';
    var statusUrl = "{{route('assistanceRequestStatus')}}";
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/web/js/assistance.js')}}"></script>
@endsection
