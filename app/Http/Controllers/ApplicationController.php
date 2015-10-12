<?php

namespace App\Http\Controllers;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('app.dashboard');
    }

    public function result()
    {
        return view('app.result');
    }

    public function assessment()
    {
        return view('app.assessment');
    }

    public function help()
    {
        return view('app.help');
    }

    public function contact()
    {
        return view('app.contact');
    }
}
