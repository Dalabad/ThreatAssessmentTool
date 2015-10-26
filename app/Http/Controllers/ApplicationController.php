<?php

namespace App\Http\Controllers;

use App\Libraries\Crawler\LinkedInCrawler;
use App\Libraries\Crawler\XingCrawler;
use App\Libraries\Importer\MaltegoImporter;
use App\Libraries\Importer\ReconNgImporter;
use App\Libraries\Importer\CreepyImporter;

class ApplicationController extends Controller
{
    public function index()
    {
//        $xingCrawler = new XingCrawler();
//        $linkedinCrawler = new LinkedInCrawler();

//        $findings = $xingCrawler::crawl("https://www.xing.com/profile/Daniel_Schosser");
//        $findings = $linkedinCrawler::crawl("https://de.linkedin.com/pub/daniel-schosser/b4/848/b33");

        $importer = new CreepyImporter();
        $findings = $importer->import('/home/daniel/Projects/University/ThreatAssessmentTool/storage/demo-files/creepy/worldtravel.kml');

        die('<pre>'.print_r($findings));
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
