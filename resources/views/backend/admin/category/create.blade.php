@extends('backend.master')
@section('title')
    Category | create
@stop
@section('breadcum')
    @include('backend.admin.includes.breadcum',['heading'=>"Category","sub_heading"=>'create'])
@stop
@section('content')
    <form class="form-control" action="{{ route('category.create') }}" method="POST" enctype="multipart/form-data">
         @include("backend.admin.category.partial.form",['type'=>'create'])
           @include("backend.admin.includes.form_footer",['type'=>'create'])
    </form>
@stop
@include("backend.admin.category.script")
