@extends('layouts.app')

@section('content')


<style>
.x-content-body {
    padding: 20px;
}

.options__ {
    margin-bottom: 10px;
}


.float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 40px;
    right: 40px;
    background-color: #0C9;
    color: #FFF;
    border-radius: 50px;
    text-align: center;
    box-shadow: 2px 2px 3px #999;
}

.my-float {
    margin-top: 22px;
}
</style>

<div class="container">
    <form action="{{route('edit.save')}}" id="saveTeamPLayer" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="form_id" value="<?= base64_encode($form->id) ?>">
        <div class="x-content row shadow-lg">
            <div class="form-group">
                <label for="usr">Form Name:</label>
                <input type="text" required class="form-control required-field" value=" {{$form->formName}}"
                    name="formName" id="formName">
            </div><br>
            @if($form->formQuestions)
            <?php $i = 1; ?>
            @foreach($form->formQuestions as $qtns)
            <div id="contentdiv_<?= $i ?>" class="x-content-body">
                <input type="hidden" name="QtnNo[]" value="<?= $i  ?>">
                <input type="hidden" name="existField[]" value="1">
                <h4>Question <?= $i ?>
                    @if($i != 1)
                    <button style="float: right;" onclick="removeQuestion(<?= $i ?>)" type="button"
                        class="btn btn-info">
                        - Remove this Question
                    </button>
                    @endif
                </h4>
                <div class="form-group">
                    <label for="usr">Label:</label>
                    <input type="text" required class="form-control required-field" value="{{$qtns->label}}"
                        name="feildLabel[]" id="feildLabel">
                </div><br>
                <div class="form-group">
                    <label for="usr">Type field:</label>
                    <select onchange="getFieldSpec(this,  <?= $i ?>)" class="form-control  required-field"
                        name="inputType[]" required id="inputType">
                        <option value="">Please Choose</option>
                        @if(!empty($input_types))
                        @foreach ($input_types as $inputTYpe)
                        <option <?php if ($qtns->type == $inputTYpe->id) echo "selected" ?> value="{{$inputTYpe->id}}"
                            data-choice_status="{{$inputTYpe->choice}}">
                            {{$inputTYpe->field}}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div><br>
                <?php $style = '';
                if (empty($qtns->formQuestion_options)) {
                    $style = 'style="display: none;"';
                } ?>
                <div <?= $style ?> id="property_div_<?= $i ?>">
                    <div class="form-group">
                        <label for="usr">Options : </label>
                        @if($qtns->formQuestion_options)
                        <?php $j = 1; ?>
                        @foreach($qtns->formQuestion_options as $option)
                        <div class="row options__" id="prop_option_q_<?= $j ?>_<?= $i ?>">
                            <input type="hidden" name="option_id[]" value="<?= base64_encode($option->id) ?>">
                            <input type="hidden" name="existOptionField[]" value="1">
                            <div class="col-md-10">
                                <input value="{{$option->option}}" data-key-id="<?= $j ?>" type=" text"
                                    class="form-control  required-field" placeholder="Enter the Options"
                                    name="Option[<?= $i ?>][]" id="Option_q_<?= $j ?>_<?= $i ?>">
                            </div>
                            <div class="col-md-2 float-right">
                                @if($j == 1)
                                <button data-qtn-id="<?= $i ?>" type="button" class="btn btn-info checkClick">+ add
                                    new
                                    options</button>
                                @else
                                <button data-remove_id="<?= $j ?>_<?= $i ?>" type="button" onclick="removeOPtio(this)"
                                    class="btn btn-danger removeOPtion__"> - remove this
                                    option</button>
                                @endif
                            </div>
                        </div>
                        <?php $j++; ?>
                        @endforeach
                        @endif

                    </div>
                </div>
            </div>
            <?php $i++; ?>
            @endforeach
            @endif

            <div style="margin: 10px;" class="row">
                <div class="col-md-12">
                    <button style="float: right;" type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>

    </form>

    <a onclick="createNextQuestion()" class="float">
        <i class="fa fa-plus my-float"></i>
    </a>
</div>

@endsection

@push('scripts')
<script>
function removeQuestion(QtnNO) {
    $("#contentdiv_" + QtnNO).remove();
}

function createNextQuestion() {
    totalQtn = $('[id^=contentdiv_]').length;
    if (totalQtn > 0) {
        var isValid = true;
        $(".required-field").not(":hidden").each(function() {
            if ($(this).val() === '')
                isValid = false;
        });
        if (isValid) {
            $.ajax({
                url: "{{ route('render.question') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    totalQtn: totalQtn
                },
                success: function(data) {
                    last__ID_Qtn = $('[id^=contentdiv_]').last().attr('id').split("_")[1];
                    $("#contentdiv_" + last__ID_Qtn).after(data);
                }
            });
        } else {
            $("#errorMessage").show().fadeOut(3200);
        }
    }
}

function getFieldSpec(t, Qtno) {
    if ($(t).find(':selected').data('choice_status')) {
        $("#property_div_" + Qtno).show();
    }
}
$('.checkClick').on('click', function() {
    qtn_id = $(this).data('qtn-id');
    addNewOptions(qtn_id);
});

function addNewOptions(qtnNo) {
    if ($("#property_div_" + qtnNo).find('.options__').length > 0) {
        errorCount = 0;
        lastInputId = '';
        $("#property_div_" + qtnNo).find('.options__').find('input').not(":hidden").each(function() {
            if ($(this).val() == '')
                errorCount++;
            else
                lastInputId = $(this).data('key-id');
        });
        if (errorCount == 0) {
            var newInputId = lastInputId + 1;
            let inputHtml = ' <div class="row options__" id="prop_option_q_' + newInputId + '_' + qtnNo + '">';
            inputHtml += '<div class="col-md-10">';
            inputHtml += '<input data-key-id="' + newInputId +
                '" type=" text" class="form-control  required-field" placeholder="Enter the Options" name="Option[' +
                qtnNo + '][]' + '" id="Option_q_' + newInputId + '_' + qtnNo +
                '">';
            inputHtml += '</div>   <div class="col-md-2 float-right">';
            inputHtml += '<button data-remove_id="' + newInputId + '_' + qtnNo +
                '" type = "button" onclick= "removeOPtio(this)" class ="btn btn-danger removeOPtion__"> - remove this option</button>';
            inputHtml += '</div> </div>';
            $($("#property_div_" + qtnNo)).append((inputHtml));
        } else {
            $("#errorMessage").show().fadeOut(3200);
        }
    }
}

function removeOPtio(t) {
    qtn_id = $(t).data('remove_id');
    $("#prop_option_q_" + qtn_id).remove();
}
</script>
@endpush