@extends('layouts.app')
@section('title')
Volunteers
@endsection

@section('content')


<div class="page-content-wrapper">
    <div class="content-container">
        <div class="page-content">
            <div class="content-header">
                <h1>Volunteers </h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashBoard')}}">Home</a></li>
                    <li class="breadcrumb-item">Volunteers</li>

                </ul>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h4>Volunteer Table </h4>
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
    var listUrl = '{{route('volunteerList')}}';
    // var deleteUrl = "{{route('deletePicnic')}}";
</script>
<script src="{{asset('assets/web/js/volunteers.js')}}"></script>
@endsection
