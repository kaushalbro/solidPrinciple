@extends('backend.master')
@section('title')
    User | index
@stop
@section('breadcum')
    @include('backend.admin.includes.breadcum',['heading'=>"Current","sub_heading"=>'Users'])
@stop
@section('content')
    @include("backend.admin.includes.errors")
    <div class="row ">
        <div class="col-12">
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th width="10px">S.N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th width="100px">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@stop
@push('scripts')
    @include("backend.admin.users.script")
@endpush
