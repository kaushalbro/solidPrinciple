@extends('backend.master')
@section('title')
    Order | create
@stop
@section('breadcum')
    @include('backend.admin.includes.breadcum',['heading'=>"Order","sub_heading"=>'create'])
@stop
@section('content')
    @include("backend.admin.includes.errors")
    <form class="" action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
         <div class="card-header">
           <h3 class="card-title">Create</h3>
         </div>
         <div class="card-body">
            @include("backend.admin.order.partial.form",['type'=>'create'])
          </div>
    </form>
@stop
@push('scripts')
   @include("backend.admin.order.script")
@endpush
