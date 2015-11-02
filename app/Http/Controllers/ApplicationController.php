<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    public function index()
    {
        $notification = Session::pull('notification');

        $companyInformation = Session::get('companyInformation');
        $findings           = Session::get('findings');
        return view('app.dashboard', compact('companyInformation', 'findings', 'notification'));
    }

    public function assessment()
    {
        $companyInformation = Session::get('companyInformation');
        return view('app.assessment', compact('companyInformation'));
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
