
@extends('layouts.app')
@section('title')
 View Picnic
@endsection

@inject('carbon', 'Carbon\Carbon')

@section('content')
<div class="page-content-wrapper">
    <div class="content-container">
        <div class="page-content">
            <div class="content-header">
                <h1>Picnic Details</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashBoard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('picnic')}}">Picnic</a></li>
                    <li class="breadcrumb-item">Product Details</li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12">
                   <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end">
                                    <a href="{{route('editPicnic', base64_encode($picnic->id))}}" class="btn btn-sm btn-primary me-2"><i class="ti ti-pencil"></i>Edit</a>

                                </div>
                                <h4 class="mb-3"><i data-feather="map-pin"></i> {{$picnic->location}}</h4>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="position-relative product-slider">
                                            <div id="carouselExampleCaptions" class="carousel slide carousel-fade"
                                                data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        @if($picnic->image != null)
                                                        <img src="{{Storage::url('picnic_images/' . $picnic->image)}}" class="d-block w-100"
                                                            alt="Product images">
                                                        @else
                                                        <img src="{{asset('assets/images/user/avatar-1.jpg')}}" alt="Image" class="rounded-circle avatar avatar-xl">
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- <ol class="carousel-indicators position-relative product-carousel-indicators">
                                                    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                                        class="w-25 h-auto active">
                                                        <img src="{{Storage::url('picnic_images/' . $picnic->image)}}" class="d-block"
                                                            alt="Product images">
                                                    </li>
                                                    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                                        class="w-25 h-auto">
                                                        <img src="../assets/images/pages/img-prod-small.jpg" class="d-block"
                                                            alt="Product images">
                                                    </li>
                                                    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                                        class="w-25 h-auto">
                                                        <img src="../assets/images/pages/img-prod-small.jpg" class="d-block"
                                                            alt="Product images">
                                                    </li>
                                                    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                                                        class="w-25 h-auto">
                                                        <img src="../assets/images/pages/img-prod-small.jpg" class="d-block"
                                                            alt="Product images">
                                                    </li>
                                                </ol> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <h2 class="mt-0">{{$picnic->title}}</h2>

                                        <div class="mt-4">
                                            <p class="text-muted mb-0">Date:</>
                                            <h4>{{$carbon::createFromFormat('Y-m-d H:i:s', $picnic->date)->format('M d Y')}} {{$carbon::createFromFormat('Y-m-d H:i:s', $picnic->date)->format('h:i A')}}</h4>
                                            <h6>({{ $carbon::parse($picnic->date)->diffForHumans() }})</h6>
                                        </div>
                                        <div class="mt-4">
                                            <h6>Description</h6>
                                            <p class="text-muted text-sm mb-0">{{$picnic->description}}
                                            </p>
                                        </div>
                                        <div class="mt-4">
                                            <h6>Agenda</h6>
                                            <p class="text-muted text-sm mb-0">{{$picnic->agenda}}
                                            </p>
                                        </div>
                                        <div class="mt-4">
                                            <h6>Status</h6>
                                            @if($picnic->status == 1)
                                              {!!config('buttons.active')!!}
                                            @else
                                              {!!config('buttons.inactive')!!}
                                            @endif
                                            </p>
                                        </div>
                                        <div class="row mt-6">
                                            <div class="col-sm-4">
                                                <div class="mt-4">
                                                    <p class="text-muted mb-0">No.Seniors:</>
                                                 {{$seniors}}
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mt-4">
                                                    <p class="text-muted mb-0">No.Volunteers:</>
                                                 {{$volunteers}}
                                                </div>
                                            </div> <div class="col-sm-4">
                                                <div class="mt-4">
                                                    <p class="text-muted mb-0">Total Joining:</>
                                                 {{$seniors+$volunteers}}
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
            </div>
        </div>
    </div>
</div>
@endsection
