<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function poster_info(Request $request)
    {
        $poster_id = $request->route('poster_id', 0);
        //dd($poster_id);
        return view('poster_info');
    }

    public function poster_generate()
    {
        return view('poster_generate');
    }
}
