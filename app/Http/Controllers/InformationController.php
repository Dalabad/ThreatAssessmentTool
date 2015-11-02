<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyInformationRequest;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\XingRequest;
use App\Libraries\Crawler\XingCrawler;
use App\Libraries\Import\MaltegoImporter;
use App\Libraries\Importer\CreepyImporter;
use App\Libraries\Importer\HarvesterImporter;
use App\Libraries\Importer\ReconNgImporter;
use App\Libraries\Importer\XingImporter;
use App\Libraries\Merger\Merger;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{

    public function companyInformation(CompanyInformationRequest $request)
    {
        $companyInformation = [
            'companyName' => $request->input('companyName'),
            'companyEmployeeCount' => $request->input('companyEmployeeCount'),
            'companyWebsite' => $request->input('companyWebsite'),
            'attackType' => $request->input('attackType'),
        ];
        Session::put('companyInformation', $companyInformation);
        Session::put('notification', 'Company Information has been saved!');

        return redirect('/');
    }

    public function reset()
    {
        Session::forget('companyInformation');
        Session::forget('findings');

        Session::put('notification', 'All gathered information has been reset!');

        return redirect('/');
    }

    public function upload(UploadRequest $request)
    {
        $file = $request->file('files')[0];

        switch ($request->input('inputToolName')) {
            case 'creepy':
                $rules = array('file' => 'required|mimes:xml');
                $importer = new CreepyImporter();
                break;
            case 'reconng':
                $rules = array('file' => 'required');
                $importer = new ReconNgImporter();
                break;
            case 'maltego':
                $rules = array('file' => 'required|mimes:xml');
                $importer = new MaltegoImporter();
                break;
            case 'theharvester':
                $rules = array('file' => 'required|mimes:xml');
                $importer = new HarvesterImporter();
                break;
        }

        $validator = Validator::make(array('file'=> $file), $rules);
        if($validator->passes()){
            $findings = $importer->import($file);
            $merger = new Merger();
            $merger->addFindings($findings);
        }

        if ($validator->fails())
        {
            return redirect('/')->withErrors($validator);
        }

        Session::put('notification', 'File has been analyzed and added!');

        return redirect('/');
    }

    public function xing(XingRequest $request)
    {
        $url = $request->input('inputXingUrl');

        switch ($request->input('inputUrlType')) {
            case 'person':
                $crawler = new XingCrawler();
                $person = $crawler->crawl($url);
                $findings['profiles'][] = $person;
                $notificationMessage = 'Xing information has been imported!';
                break;
            case 'company':
                if(ends_with($url, '/'))
                    $url = substr($url,0,strlen($url)-1);
                $importer = new XingImporter();
                $findings = $importer->import($url);
                $notificationMessage = 'Xing Company information has been imported!';
                break;
        }

        $merger = new Merger();
        $merger->addFindings($findings);

        Session::put('notification', $notificationMessage);

        return redirect('/');
    }
}
