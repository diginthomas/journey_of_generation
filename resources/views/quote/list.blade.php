@extends('layouts.app')
@section('title')
 Quotes
@endsection

@section('content')


<div class="page-content-wrapper">
    <div class="content-container">
        <div class="page-content">
            <div class="content-header">
                <h1>Quotes </h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashBoard')}}">Home</a></li>
                    <li class="breadcrumb-item">Quotes</li>

                </ul>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h4>Quote Table </h4><span style="float: right;">
                                <button data-pc-animate="fade-in-scale" type="button" title="Add Quote" class="btn btn-primary add-btn"
                                data-bs-toggle="modal" data-bs-target="#animateModal">
                                <i data-feather="plus-circle"></i>
                               Add Quote
                            </button>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="quote-list-table">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modal --}}
<div class="modal fade modal-animate"  id="animateModal" tabindex="-1" aria-labelledby="animateModalLabel"
    aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
             <form id="quote-add-form" method="post">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                </button>
            </div>
            <div class="modal-body">

                    <label  class="form-label">Quote:</label>
                    <textarea class="form-control" id="quote" name="description" placeholder="Add new quote"></textarea>
                    <input type="hidden" name="id" id="id">

            </div>
            <div class="modal-footer">
                <button type="button" id="close-quite-modal" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" type="submit" id="submit-quote" class="btn btn-primary shadow-2">Save
                    changes</button>
            </div>
             </form>
        </div>
    </div>
</div>
{{-- modal ends --}}
@endsection
@section('scripts')
<script>
    var page = "listPage";
    var listUrl = "{{route('quoteList')}}";
    var deleteUrl = "{{route('deleteQuote')}}";
    var saveUrl = "{{route('saveQuote')}}";
    var editUrl = "{{route('editQuote')}}";
</script>
<script src="{{asset('assets/web/js/quote.js')}}"></script>
@endsection
