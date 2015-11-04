<?php

namespace App\Http\Controllers;

use App\Libraries\Mapper\AttackTypes2Characteristics;
use App\Libraries\ThreatAssessment\Calculator;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    public function index()
    {
        $notification = Session::pull('notification');

        $companyInformation = Session::get('companyInformation');
        $findings           = Session::get('findings');

        $characteristics = [];
        if(isset($companyInformation['attackType'])) {
            $calculator = new Calculator($companyInformation, $findings);
            $characteristics = $calculator->calculateThreat($companyInformation['attackType']);
        }

        return view('app.dashboard', compact('companyInformation', 'findings', 'notification', 'characteristics'));
    }

    public function assessment()
    {
        $companyInformation = Session::get('companyInformation');
        $findings = Session::get('findings');

        $characteristics = [];
        if(isset($companyInformation['attackType'])) {
            $calculator = new Calculator($companyInformation, $findings);
            $characteristics = $calculator->calculateThreat($companyInformation['attackType']);
        }

        return view('app.assessment', compact('companyInformation', 'findings', 'characteristics'));
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

        $characteristics = [];
        if(isset($data['attackType'])) {
            $calculator = new Calculator($data, $findings);
            $characteristics = $calculator->calculateThreat($data['attackType']);
        }

        $profilesArray = array_chunk($findings['profiles'], 5);
        $emailsArray = array_chunk($findings['emails'], 30);
        $websitesArray = array_chunk($findings['websites'], 30);
        $locationsArray = array_chunk($findings['locations'], 16);

        $overallFindingsAmount = count($findings['profiles'])+count($findings['emails'])+count($findings['websites'])+count($findings['locations']);
        $percentageFindings = [
            'profiles' => number_format(100/$overallFindingsAmount*count($findings['profiles']), 2),
            'emails' => number_format(100/$overallFindingsAmount*count($findings['emails']), 2),
            'websites' => number_format(100/$overallFindingsAmount*count($findings['websites']), 2),
            'locations' => number_format(100/$overallFindingsAmount*count($findings['locations']), 2)
        ];

        $dateAndTime = Carbon::createFromTimestamp(time())->format('F j, Y, h:i a');

        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadView('pdf.threat', compact('data', 'locationsArray', 'profilesArray', 'emailsArray', 'websitesArray', 'findings', 'dateAndTime', 'percentageFindings', 'characteristics'));
        return $pdf->stream();
    }
}
