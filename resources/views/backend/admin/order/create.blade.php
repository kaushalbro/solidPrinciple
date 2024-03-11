@extends('backend.master')
@section('title')
    Order | create
@stop
@section('breadcum')
    @include('backend.admin.includes.breadcum',['heading'=>"Order","sub_heading"=>'create'])
@stop
@section('content')
    <form class="form-control" action="{{ route('order.create') }}" method="POST" enctype="multipart/form-data">
         @include("backend.admin.order.partial.form",['type'=>'create'])
           @include("backend.admin.includes.form_footer",['type'=>'create'])
    </form>
@stop
@include("backend.admin.order.script")
