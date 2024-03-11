@extends('backend.master')
@section('title')
    Product | create
@stop
@section('breadcum')
    @include('backend.admin.includes.breadcum',['heading'=>"Product","sub_heading"=>'create'])
@stop
@section('content')
    <form class="form-control" action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data">
         @include("backend.admin.product.partial.form",['type'=>'create'])
           @include("backend.admin.includes.form_footer",['type'=>'create'])
    </form>
@stop
@include("backend.admin.product.script")
