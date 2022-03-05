@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <form action="">
            <h1> {{$form->formName}}</h1>
            <?php $qtns = $form->formQuestions; ?>
            @foreach($qtns as $Qtn)
            <?php $type = $Qtn->getTypeDetails->component; ?>
            <?php $choice = $Qtn->getTypeDetails->choice; ?>
            <?php $options = $Qtn->formQuestion_options; ?>

            <div class="row">
                <?php $component = 'x-' + $type; ?>
                <<?= $component ?> :Qtn="$Qtn" :choice="$choice" :options="$options">
                    <<?= $component ?> />
            </div>

            @endforeach
        </form>
    </div>
</div>

@endsection

@push('scripts')

@endpush