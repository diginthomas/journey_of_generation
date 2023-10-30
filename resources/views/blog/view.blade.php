
@extends('layouts.app')
@section('title')
 View Blog
@endsection

@inject('carbon', 'Carbon\Carbon')

@section('content')
<div class="page-content-wrapper">
    <div class="content-container">
        <div class="page-content">
            <div class="content-header">
                <h1>Blog Details</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashBoard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('blogs')}}">Blog</a></li>
                    <li class="breadcrumb-item">Blog Details</li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12">
                   <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end">
                                    <a href="{{route('editBlog', base64_encode($blog->id))}}" title="Edit Blog" class="btn btn-sm btn-primary me-2"><i class="ti ti-pencil"></i>Edit</a>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="position-relative product-slider">
                                            <div id="carouselExampleCaptions" class="carousel slide carousel-fade"
                                                data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                      @if($blog->image != null)
                                                      <img src="{{Storage::url('blog_images/' . $blog->image)}}" class="d-block w-100"
                                                          alt="Product images">
                                                      @else
                                                      <img src="{{asset('assets/images/user/avatar-1.jpg')}}" alt="Image" class="rounded-circle avatar avatar-xl">
                                                      @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <h2 class="mt-0">{{$blog->title}}</h2>
                                        <div class="mt-4">
                                            <p class="text-muted mb-0">Date:</>
                                            <h4>{{$carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at)->format('M d Y')}} </h4>
                                        </div>
                                        <div class="mt-4">
                                            <h6>Description</h6>
                                            <p class="text-muted text-sm mb-0">{{$blog->description}}
                                            </p>
                                        </div>
                                        <div class="mt-4">
                                            <h6>Author</h6>
                                            <p class="text-muted text-sm mb-0">{{$blog->author->first_name}} {{$blog->author->last_name}}
                                            </p>
                                        </div>
                                        <div class="mt-4">
                                            <h6>Status</h6>
                                            @if($blog->status == 1)
                                              {!!config('buttons.active')!!}
                                            @else
                                              {!!config('buttons.inactive')!!}
                                            @endif
                                            </p>
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
