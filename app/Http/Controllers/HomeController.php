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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['forms'] = Forms::where('is_active', 1)->get();
        return view('home', $data);
    }
}