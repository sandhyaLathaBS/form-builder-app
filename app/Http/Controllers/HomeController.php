<?php

namespace App\Http\Controllers;

use App\Models\Forms;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function forms()
    {
        $data['forms'] = Forms::where('is_active', 1)->get();
        return view('welcome', $data);
    }

    public function showForm($id)
    {
        $formId = base64_decode($id);
        $data['form'] = Forms::where('id', $formId)->where('is_active', 1)->first();
        return view('build', $data);
    }
}