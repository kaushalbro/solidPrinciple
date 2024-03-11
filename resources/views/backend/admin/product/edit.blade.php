@extends('backend.master')
@section('title')
    Product | edit
@stop
@section('breadcum')
    @include('backend.admin.includes.breadcum',['heading'=>"Product","sub_heading"=>'edit'])
@stop
@section('content')
        <form class="form-control" action="{{ route('product.edit', ['id' => $product->id]) }}" method="PUT" enctype="multipart/form-data">
             @include("backend.admin.product.partial.form",['type'=>'edit'])
               @include("backend.admin.includes.form_footer",['type'=>'edit'])
        </form>
@stop
@include("backend.admin.product.script")
