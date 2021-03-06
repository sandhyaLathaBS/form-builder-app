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
                                <a class="btn btn-info "
                                    href="{{url('/view-this-form')}}/<?= base64_encode($form->id) ?>">View</a>
                                <a class="btn btn-success"
                                    href="{{url('/edit-this-form')}}/<?= base64_encode($form->id) ?>">Edit</a>
                                <a onclick="deleteThisForm('<?= base64_encode($form->formToken) ?>')"
                                    class="btn btn-warning ">Delete</a>

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

@push('scripts')
<script>
function deleteThisForm(formToken) {
    $.ajax({
        url: "{{ route('delete.form') }}",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            formToken: formToken
        },
        success: function(data) {
            location.reload();
        }
    });
}
</script>
@endpush