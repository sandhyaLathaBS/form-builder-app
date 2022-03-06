@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <form method="POST" enctype='multipart/form-data' action="">
            <h1> {{$form->formName}}</h1>
            <?php $qtns = $form->formQuestions; ?>
            @foreach($qtns as $Qtn)
            <?php $type = $Qtn->getTypeDetails->component; ?>
            <?php $choice = $Qtn->getTypeDetails->choice; ?>
            <?php $options = $Qtn->formQuestion_options; ?>
            <div class="row">
                @widget($type, ['choice'=>$choice, 'options'=>$options,'Qtn_details'=> $Qtn])
            </div>
            @endforeach
            <div style="margin: 10px;" class="row">
                <div class="col-md-12">
                    <button style="float: right;" type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')

@endpush