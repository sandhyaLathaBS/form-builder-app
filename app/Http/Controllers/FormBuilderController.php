<?php

namespace App\Http\Controllers;

use App\Models\InputFormTypes;
use Illuminate\Http\Request;

class FormBuilderController extends Controller
{
    public function index()
    {
        $data['input_types'] = InputFormTypes::get();
        return view('form-create', $data);
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
        dd($request->all());
    }
}