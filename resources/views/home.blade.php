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
                <table id="datatable-list" class="shadow-lg table table-hover table-bordered ">
                    <thead>
                        <tr>
                            <th>sl no:</th>
                            <th>Form Name</th>
                            <th>Input Feilds</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($forms)) <?php $i = 1; ?>
                        @foreach($forms as $form)
                        <tr>
                            <td>{{$i++;}}</td>
                            <td>{{$form->formName}}</td>
                            <td>{{count($form->formQuestions)}}</td>
                            <td>
                                <a class="btn btn-info ">View</a>
                                <a class="btn btn-success ">Edit</a>
                                <a class="btn btn-warning ">Delete</a>

                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection