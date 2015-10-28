<?php

namespace App\Http\Controllers;

use App\Libraries\Importer\CreepyImporter;
use App\Libraries\Importer\HarvesterImporter;
use App\Libraries\Importer\ReconNgImporter;
use App\Libraries\Importer\XingImporter;
use App\Libraries\Merger\Merger;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    public function index()
    {
        if(!Session::has('findings')) {

            $reconNg = new ReconNgImporter();
            $reconNgFindings = $reconNg->import('/home/daniel/Projects/University/ThreatAssessmentTool/storage/demo-files/recon-ng/egym.json');

            $harvester = new HarvesterImporter();
            $harvesterFindings = $harvester->import('/home/daniel/Projects/University/ThreatAssessmentTool/storage/demo-files/theharvester/egym.xml');

            $creepy = new CreepyImporter();
            $creepyFindings = $creepy->import('/home/daniel/Projects/University/ThreatAssessmentTool/storage/demo-files/creepy/worldtravel.kml');

            $xing = new XingImporter();
            $xingFindings = $xing->import('https://www.xing.com/companies/egymgmbh');

            $merger = new Merger();
            $merger->addFindings($harvesterFindings);
            $merger->addFindings($creepyFindings);
            $merger->addFindings($reconNgFindings);
            $merger->addFindings($xingFindings);

            Session::put('findings', $merger->getFindings());
        }

        return view('app.dashboard');
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
