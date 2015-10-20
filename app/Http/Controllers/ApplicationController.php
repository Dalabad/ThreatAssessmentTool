<?php

namespace App\Http\Controllers;

use App\Libraries\Crawler\LinkedInCrawler;
use App\Libraries\Crawler\XingCrawler;

class ApplicationController extends Controller
{
    public function index()
    {
//        $xingCrawler = new XingCrawler();
//        $findings = $xingCrawler::crawl("https://www.xing.com/profile/Daniel_Schosser");

//        $linkedinCrawler = new LinkedInCrawler();
//        $findings = $linkedinCrawler::crawl("https://de.linkedin.com/pub/daniel-schosser/b4/848/b33");

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
