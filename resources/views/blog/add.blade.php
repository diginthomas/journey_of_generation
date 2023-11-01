
@extends('layouts.app')
@section('title')
 Add Blog
@endsection

@section('content')

<!-- [ Main Content ] start -->
<div class="page-content-wrapper">
    <div class="content-container">
        <div class="page-content">
            <div class="content-header">
                <h1>Add Blog</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashBoard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('blogs')}}">Blog</a></li>
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
                                    <form id="blog_form" method="post">
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label class="form-label"> Title: </label>
                                                <input type="text" name="title" class="form-control"  placeholder="Title">
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label">Blog image:</label>
                                                <input type="file" name="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
                                                <span><small>Supports .jpeg, .jpg, .png | Max 5 MB</small></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label  class="form-label">Description:</label>
                                                <textarea class="form-control" name="description" placeholder="Description" rows="7"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-lg-4">
                                          <div class="form-check form-switch custom-switch-v1">
                                              <input type="checkbox" class="form-check-input input-success"
                                                  id="status" name="status">
                                              <label class="form-check-label" for="customswitchv1-3">Active</label>
                                          </div>
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
    var saveUrl = "{{route('saveBlog')}}";
    $('#status').prop('checked', true).change();
  </script>
  <script src="{{asset('assets/web/js/blog.js')}}"></script>
@endsection
