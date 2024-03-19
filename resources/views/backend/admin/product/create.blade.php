@extends('backend.master')
@section('title')
    Product | create
@stop
@section('breadcum')
    @include('backend.admin.includes.breadcum',['heading'=>"Product","sub_heading"=>'create'])
@stop
@section('content')
    @include("backend.admin.includes.errors")
    <form class="" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
         <div class="card-body">
            @include("backend.admin.product.partial.form",['type'=>'create'])
          </div>
    </form>
@stop
@push('scripts')
   @include("backend.admin.product.script")
@endpush
