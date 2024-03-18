@extends('backend.master')
@section('title')
    Category | edit
@stop
@section('breadcum')
    @include('backend.admin.includes.breadcum',['heading'=>"Category","sub_heading"=>'edit'])
@stop
@section('content')
    @include("backend.admin.includes.errors")
        <form class="form-control" action="{{ route('categories.update') }}', ['id' => $category->id]) }}" method="PUT" enctype="multipart/form-data">
    @csrf
        <div class="card-header">
           <h3 class="card-title">Create</h3>
         </div>
         <div class="card-body">
            @include("backend.admin.category.partial.form",['type'=>'edit'])
          </div>
    </form>
@stop
@push('scripts')
   @include("backend.admin.category.script")
@endpush
