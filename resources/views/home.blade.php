@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success btn-lg ml-3">
                <a class="text-light" href="{{url('create-new-form')}}">Build New Form</a>
            </button>
        </div>
    </div><br><br>
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <table id="datatable-list" class="table table-hover table-bordered ">
                    <thead>
                        <tr>
                            <th>sl no:</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Offer Percentage</th>
                            <th>Offered By</th>
                            <th>Start Date</th>
                            <th>Created At</th>
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection