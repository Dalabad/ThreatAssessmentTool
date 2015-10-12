<?php

namespace App\Http\Controllers;

class ResultController extends Controller
{
    public function index()
    {
        return view('result.index');
    }

    public function people()
    {
        return view('result.people');
    }

    public function mail()
    {
        return view('result.mail');
    }

    public function location()
    {
        return view('result.location');
    }

    public function website()
    {
        return view('result.website');
    }
}
