@extends('backend.master')
@section('title')
    Order | edit
@stop
@section('breadcum')
    @include('backend.admin.includes.breadcum',['heading'=>"Order","sub_heading"=>'edit'])
@stop
@section('content')
    @include("backend.admin.includes.errors")
        <form class="form-control" action="{{ route('orders.update') }}', ['id' => $order->id]) }}" method="PUT" enctype="multipart/form-data">
    @csrf
        <div class="card-header">
           <h3 class="card-title">Create</h3>
         </div>
         <div class="card-body">
            @include("backend.admin.order.partial.form",['type'=>'edit'])
          </div>
    </form>
@stop
@push('scripts')
   @include("backend.admin.order.script")
@endpush
