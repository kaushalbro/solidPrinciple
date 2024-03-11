@extends('backend.master')
@section('title')
    Order | edit
@stop
@section('breadcum')
    @include('backend.admin.includes.breadcum',['heading'=>"Order","sub_heading"=>'edit'])
@stop
@section('content')
        <form class="form-control" action="{{ route('order.edit', ['id' => $order->id]) }}" method="PUT" enctype="multipart/form-data">
             @include("backend.admin.order.partial.form",['type'=>'edit'])
               @include("backend.admin.includes.form_footer",['type'=>'edit'])
        </form>
@stop
@include("backend.admin.order.script")
