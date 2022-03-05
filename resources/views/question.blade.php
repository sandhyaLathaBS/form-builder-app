<div id="contentdiv_{{$nextQtnCount}}" class="x-content-body">
    <input type="hidden" name="QtnNo[]" value="{{$nextQtnCount}}">
    <h4>Question {{$nextQtnCount}}
        <button style="float: right;" onclick="removeQuestion('{{$nextQtnCount}}')" type="button" class="btn btn-info">
            - Remove this Question
        </button>
    </h4>
    <div class="form-group">
        <label for="usr">Label:</label>
        <input type="text" required class="form-control required-field" name="feildLabel[]" id="feildLabel">
    </div><br>
    <div class="form-group">
        <label for="usr">Type field:</label>
        <select onchange="getFieldSpec(this, '{{$nextQtnCount}}')" class="form-control  required-field"
            name="inputType[]" required id="inputType">
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
    <div style="display: none;" id="property_div_{{$nextQtnCount}}">
        <div class="form-group">
            <label for="usr">Options : </label>
            <div class="row options__" id="prop_option_q_1_{{$nextQtnCount}}">
                <div class="col-md-10">
                    <input data-key-id="1" type=" text" class="form-control  required-field"
                        placeholder="Enter the Options" name="Option[{{$nextQtnCount}}][]"
                        id="Option_q_1_{{$nextQtnCount}}">
                </div>
                <div class="col-md-2 float-right">
                    <button data-qtn-id="{{$nextQtnCount}}" type="button" onclick="addNewOptions('{{$nextQtnCount}}')"
                        class="btn btn-info">+ add
                        new
                        options</button>
                </div>
            </div>
        </div>
    </div>
</div>