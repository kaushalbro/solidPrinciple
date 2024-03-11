@extends('backend.master')
@section('title')
    Category | edit
@stop
@section('breadcum')
    @include('backend.admin.includes.breadcum',['heading'=>"Category","sub_heading"=>'edit'])
@stop
@section('content')
        <form class="form-control" action="{{ route('category.edit', ['id' => $category->id]) }}" method="PUT" enctype="multipart/form-data">
             @include("backend.admin.category.partial.form",['type'=>'edit'])
               @include("backend.admin.includes.form_footer",['type'=>'edit'])
        </form>
@stop
@include("backend.admin.category.script")
