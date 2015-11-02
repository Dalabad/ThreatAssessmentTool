<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Knp\Snappy\Pdf;

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

    public function pdf()
    {
        $data = Session::get('companyInformation');
        $findings = Session::get('findings');

        $profilesArray = array_chunk($findings['profiles'], 5);
        $emailsArray = array_chunk($findings['emails'], 30);
        $websitesArray = array_chunk($findings['websites'], 30);
        $locationsArray = array_chunk($findings['locations'], 16);

        $dateAndTime = Carbon::createFromTimestamp(time())->format('F j, Y, h:i a');

        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadView('pdf.threat', compact('data', 'locationsArray', 'profilesArray', 'emailsArray', 'websitesArray', 'findings', 'dateAndTime'));
        return $pdf->stream();
    }
}
