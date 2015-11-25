<?php

namespace App\Http\Controllers;

use App\Libraries\Api\XingApi;
use App\Libraries\Mapper\AttackTypes2Characteristics;
use App\Libraries\ThreatAssessment\Calculator;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            $characteristics = AttackTypes2Characteristics::getCharacteristics($companyInformation['attackType']);
        }

        return view('app.dashboard', compact('companyInformation', 'findings', 'notification', 'characteristics'));
    }

    public function assessment()
    {
        $data = Session::get('companyInformation');
        $findings = Session::get('findings');

        $characteristics = [];
        $threatValue = 0;
        if(isset($data['attackType'])) {
            $calculator = new Calculator($data, $findings);
            $characteristics = $calculator->getCharacteristicsWithThreatValue($data['attackType']);
            $threatValue = $calculator->calculateThreat($data['attackType']);
        }

        return view('app.assessment', compact('findings', 'characteristics', 'threatValue', 'data'));
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

        $profilesArray = [];
        $locationsArray = [];
        $emailsArray = [];
        $websitesArray = [];

        $characteristics = [];
        $threatValue = 0;
        if(isset($data['attackType'])) {
            $calculator = new Calculator($data, $findings);
            $characteristics = $calculator->getCharacteristicsWithThreatValue($data['attackType']);
            $threatValue = $calculator->calculateThreat($data['attackType']);
        }

        $profiles = $findings['profiles'];
        if(count($profiles)) {
            usort($profiles, array($this, 'cmpProfiles'));
            $profilesArray = array_chunk($profiles, 4);
        }

        $locations = $findings['locations'];
        if(count($locations)) {
            $locationsArray = array_chunk($locations, 9)[0];
            $locationsArray = array_merge([$locationsArray], array_chunk(array_splice($locations, 9), 16));
        }

        if(count($findings['emails'])) {
            $emailsArray = array_chunk($findings['emails'], 30);
        }

        if(count($findings['websites'])) {
            $websitesArray = array_chunk($findings['websites'], 30);
        }

        $overallFindingsAmount = count($findings['profiles'])+count($findings['emails'])+count($findings['websites'])+count($findings['locations']);

        // Avoid division by zero
        if($overallFindingsAmount == 0) {
            $overallFindingsAmount = 1;
        }
        $percentageFindings = [
            'profiles' => number_format(100/$overallFindingsAmount*count($findings['profiles']), 2),
            'emails' => number_format(100/$overallFindingsAmount*count($findings['emails']), 2),
            'websites' => number_format(100/$overallFindingsAmount*count($findings['websites']), 2),
            'locations' => number_format(100/$overallFindingsAmount*count($findings['locations']), 2)
        ];

        $dateAndTime = Carbon::createFromTimestamp(time())->format('F j, Y, h:i a');

        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadView('pdf.threat', compact('data', 'locationsArray', 'profilesArray', 'emailsArray', 'websitesArray', 'findings', 'dateAndTime', 'percentageFindings', 'characteristics', 'threatValue'));
        return $pdf->stream();
    }

    private function cmpProfiles($a, $b) {
        if(!isset($a->getAttributes()['last-name']))
            return 1;
        if(!isset($b->getAttributes()['last-name']))
            return -1;

        if ($a->getAttributes()['last-name'] == $b->getAttributes()['last-name']) {
            return 0;
        }

        return ($a->getAttributes()['last-name'] < $b->getAttributes()['last-name']) ? -1 : 1;
    }
}
