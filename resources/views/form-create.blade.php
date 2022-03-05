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
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-warning" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div id="errorMessage" style="display: none;" class="alert alert-warning" role="alert">
                Please fill data
            </div>
        </div>
    </div>
</div>
<div class="container">
    <form action="{{route('create.save')}}" id="saveTeamPLayer" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="x-content row shadow-lg">
            <div id="contentdiv_1" class="x-content-body">
                <input type="hidden" name="QtnNo[]" value="1">
                <h4>Question 1</h4>
                <div class="form-group">
                    <label for="usr">Label:</label>
                    <input type="text" required class="form-control required-field" name="feildLabel[]" id="feildLabel">
                </div><br>
                <div class="form-group">
                    <label for="usr">Type field:</label>
                    <select onchange="getFieldSpec(this, 1)" class="form-control  required-field" name="inputType[]"
                        required id="inputType">
                        <option value="">Please Choose</option>
                        @if(!empty($input_types))
                        @foreach ($input_types as $inputTYpe)
                        <option value="{{$inputTYpe->id}}" data-choice_status="{{$inputTYpe->choice}}">
                            {{$inputTYpe->field}}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div><br>
                <div style="display: none;" id="property_div_1">
                    <div class="form-group">
                        <label for="usr">Options : </label>
                        <div class="row options__" id="prop_option_q_1_1">
                            <div class="col-md-10">
                                <input data-key-id="1" type=" text" class="form-control  required-field"
                                    placeholder="Enter the Options" name="Option_q_1[]" id="Option_q_1_1">
                            </div>
                            <div class="col-md-2 float-right">
                                <button data-qtn-id="1" type="button" class="btn btn-info checkClick">+ add
                                    new
                                    options</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                '" type=" text" class="form-control  required-field" placeholder="Enter the Options" name="Option_q_' +
                qtnNo + '[]" id="Option_q_' + newInputId + '_' + qtnNo +
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