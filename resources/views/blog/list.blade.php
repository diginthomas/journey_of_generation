@extends('layouts.app')
@section('title')
 Blogs
@endsection

@section('content')

<div class="page-content-wrapper">
    <div class="content-container">
        <div class="page-content">
            <div class="content-header">
                <h1>Blog </h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashBoard')}}">Home</a></li>
                    <li class="breadcrumb-item">Blogs</li>

                </ul>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h4>Blog Table </h4><span style="float: right;"> <a href="{{route('addBlog')}}" title="Add Blog"  class="btn btn-primary"><i data-feather="plus-circle"></i> Add Picnic</a></span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="blog-table">
                                    {{-- customer_ageing_table --}}
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
    var listUrl = '{{route('blogsData')}}';
    var deleteUrl = "{{route('deleteBlog')}}";
</script>
<script src="{{asset('assets/web/js/blog.js')}}"></script>
@endsection
