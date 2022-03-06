<?php

namespace App\Http\Controllers;

use App\Models\FormQuestions;
use App\Models\Forms;
use App\Models\InputFormTypes;
use App\Models\QuestionOptions;
use Illuminate\Http\Request;

class FormBuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['input_types'] = InputFormTypes::get();

        return view('form-create', $data);
    }

    public function dashboard()
    {
        $data['forms'] = Forms::where('is_active', 1)->get();
        return view('home', $data);
    }

    public function renderQuestion(Request $request)
    {
        $data['input_types'] = InputFormTypes::get();
        $data['nextQtnCount'] = ($request->totalQtn) + 1;
        $html = view('question', $data)->render();
        return $html;
    }

    public function save(Request $request)
    {
        $feildLabel = $request->feildLabel;
        $inputType = $request->inputType;
        $QtnNos = $request->QtnNo;
        if (!empty($QtnNos)) {
            if ($request->formName) {
                $form_token =  md5(uniqid(true));
                Forms::insert([
                    'formName' => $request->formName,
                    'formToken' => $form_token,
                    'is_active' => 1,
                    'created_at' => date('d-m-y H:i:s'),
                    'updated_at' => date('d-m-y H:i:s')
                ]);
                foreach ($QtnNos as $key => $QtnNo) {
                    if (isset($feildLabel[$key])) {
                        $formQuestionId = FormQuestions::insertGetId([
                            'label' => $feildLabel[$key],
                            'type' => $inputType[$key],
                            'form_token' => $form_token,
                            'required' => 1,
                            'is_active' => 1,
                            'created_at' => date('d-m-y H:i:s'),
                            'updated_at' => date('d-m-y H:i:s')
                        ]);
                        if ($formQuestionId > 0 && (new \App\Helper)->check_input_choice($inputType[$key])) {
                            if (isset($request->Option[$QtnNo])) {
                                foreach ($request->Option[$QtnNo] as $option) {
                                    QuestionOptions::insert([
                                        'question_id' => $formQuestionId,
                                        'option' => $option,
                                        'form_token' => $form_token,
                                        'is_active' => 1,
                                        'created_at' => date('d-m-y H:i:s'),
                                        'updated_at' => date('d-m-y H:i:s')
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }
        return redirect('home');
    }

    public function deleteForm(Request $request)
    {
        if ($request->formToken) {
            $formToken__ = base64_decode($request->formToken);
            if (Forms::where('formToken', $formToken__)->exists()) {
                Forms::where('formToken', $formToken__)->delete();
                FormQuestions::where('form_token', $formToken__)->delete();
                QuestionOptions::where('form_token', $formToken__)->delete();
            }
        }
    }

    public function editFormData_view($id)
    {
        $uid = base64_decode($id);
        if ($uid) {
            $data['input_types'] = InputFormTypes::get();
            $data['form'] = Forms::where('id', $uid)->where('is_active', 1)->first();
            return view('view-form', $data);
        }
    }

    public function update(Request $request)
    {
        $formId = base64_decode($request->form_id);
        if (Forms::where('id', $formId)->where('is_active', 1)->exists()) {
            Forms::where('id', $formId)->where('is_active', 1)
                ->update(['formName' => $request->formName]);
            $formDetails = Forms::where('id', $formId)->where('is_active', 1)->first();
            $formToken = $formDetails->formToken;
            if ($formToken) {
                FormQuestions::where('form_token', $formToken)->delete();
                QuestionOptions::where('form_token', $formToken)->delete();
                $feildLabel = $request->feildLabel;
                $inputType = $request->inputType;
                $QtnNos = $request->QtnNo;
                $form_token = $formToken;
                if (!empty($QtnNos)) {
                    foreach ($QtnNos as $key => $QtnNo) {
                        if (isset($feildLabel[$key])) {
                            $formQuestionId = FormQuestions::insertGetId([
                                'label' => $feildLabel[$key],
                                'type' => $inputType[$key],
                                'form_token' => $form_token,
                                'required' => 1,
                                'is_active' => 1,
                                'created_at' => date('d-m-y H:i:s'),
                                'updated_at' => date('d-m-y H:i:s')
                            ]);
                            if ($formQuestionId > 0 && (new \App\Helper)->check_input_choice($inputType[$key])) {
                                if (isset($request->Option[$QtnNo])) {
                                    foreach ($request->Option[$QtnNo] as $option) {
                                        QuestionOptions::insert([
                                            'question_id' => $formQuestionId,
                                            'option' => $option,
                                            'form_token' => $form_token,
                                            'is_active' => 1,
                                            'created_at' => date('d-m-y H:i:s'),
                                            'updated_at' => date('d-m-y H:i:s')
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return redirect("view-this-form/" . base64_encode($formId));
        }
        return redirect('home');
    }
}