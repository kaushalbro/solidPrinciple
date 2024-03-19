@extends('backend.master')
@section('title')
    Product | edit
@stop
@section('breadcum')
    @include('backend.admin.includes.breadcum',['heading'=>"Product","sub_heading"=>'edit'])
@stop
@section('content')
    @include("backend.admin.includes.errors")
        <form class="form-control" action="{{ route('products.update',['id' => $product->id])}}" method="PUT" enctype="multipart/form-data">
    @csrf
         <div class="card-body">
            @include("backend.admin.product.partial.form",['type'=>'edit'])
          </div>
    </form>
@stop
@push('scripts')
   @include("backend.admin.product.script")
@endpush
