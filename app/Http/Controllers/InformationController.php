<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaitingRequest;
use App\Http\Requests\CompanyInformationRequest;
use App\Http\Requests\ImpersonationRequest;
use App\Http\Requests\PhishingRequest;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\XingRequest;
use App\Libraries\Api\XingApi;
use App\Libraries\Crawler\XingCrawler;
use App\Libraries\Import\MaltegoImporter;
use App\Libraries\Importer\CreepyImporter;
use App\Libraries\Importer\HarvesterImporter;
use App\Libraries\Importer\ReconNgImporter;
use App\Libraries\Importer\XingImporter;
use App\Libraries\Merger\Merger;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{

    public function companyInformation(CompanyInformationRequest $request)
    {
        $companyInformation = [
            'companyName'           => $request->input('companyName'),
            'companyEmployeeCount'  => $request->input('companyEmployeeCount'),
            'companyWebsite'        => $request->input('companyWebsite'),
            'attackType'            => $request->input('attackType'),
            'companyLocation'       => 0,
            'companyLingo'          => 0,
            'socialAccounts'        => 0,
            'companySoftware'       => 0,
            'companyNetwork'        => 0,
            'companySecurity'       => 0
        ];
        Session::put('companyInformation', $companyInformation);
        Session::put('notification', 'Company Information has been saved!');

        return redirect('/');
    }

    public function phishing(PhishingRequest $request)
    {
        $companyInformation = Session::get('companyInformation');
        $companyInformation['companyLocation']  = $request->input('inputCompanyLocation');
        $companyInformation['companyLingo']     = $request->input('inputCompanyLingo');
        $companyInformation['socialAccounts']   = $request->input('inputSocialAccounts');

        Session::put('companyInformation', $companyInformation);
        Session::put('notification', 'Information has been saved!');

        return redirect('/');
    }

    public function baiting(BaitingRequest $request)
    {
        $companyInformation = Session::get('companyInformation');
        $companyInformation['companyLocation']  = $request->input('inputCompanyLocation');
        $companyInformation['companySoftware']  = $request->input('inputCompanySoftware');
        $companyInformation['companyNetwork']   = $request->input('inputCompanyNetwork');
        $companyInformation['companySecurity']  = $request->input('inputCompanySecurity');

        Session::put('companyInformation', $companyInformation);
        Session::put('notification', 'Company Information has been saved!');

        return redirect('/');
    }

    public function impersonation(ImpersonationRequest $request)
    {
        $companyInformation = Session::get('companyInformation');
        $companyInformation['companyLocation']  = $request->input('inputCompanyLocation');
        $companyInformation['companyLingo']     = $request->input('inputCompanyLingo');
        $companyInformation['socialAccounts']   = $request->input('inputSocialAccounts');
        $companyInformation['companySecurity']   = $request->input('inputCompanySecurity');

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
                $notificationMessage = 'Xing information has been imported!';
                Session::put('notification', $notificationMessage);
                $splittedURL = str_split($url);
                $url = explode('/', $url);
                if($splittedURL[count($splittedURL)-1] == '/') {
                    $profileIds = [$url[count($url)-2]];
                } else {
                    $profileIds = [$url[count($url)-1]];
                }
                Session::put('XingProfileIDs', $profileIds);
                return redirect('/api/xing/'.time());
            case 'company':
                if(ends_with($url, '/')) {
                    $url = substr($url, 0, strlen($url) - 1);
                }
                $notificationMessage = 'Xing Company information has been imported!';
                Session::put('notification', $notificationMessage);

                $importer = new XingImporter();
                return $importer->import($url);
        }

        return redirect('/');
    }

    public function xingApi(Request $request) {
        $token  = $request->get('oauth_token');
        $verify = $request->get('oauth_verifier');

        $xingApi = new XingApi($token,$verify);
        if(!$token && !$verify) {
            return redirect($xingApi->requestRequestToken());
        } else {
            // Get profileIDs
            $profileIDs = Session::get('XingProfileIDs');

            if(!count($profileIDs))
                return redirect('/result');

            // Grab first 100 IDs
            $firstHundredIDs = array_splice($profileIDs,0,100);

            // Remove selected IDs from Session
            $profileIDS = array_diff($profileIDs, $firstHundredIDs);
            Session::put('XingProfileIDs', $profileIDS);

            $implodedIds = implode(',',$firstHundredIDs);
            $result = $xingApi->requestXingProfiles($implodedIds);

            $findings['profiles'] = [];

            foreach($result['users'] as $user) {
                $languages = "";
                foreach($user['languages'] as $lang => $skill) {
                    if($skill != null) {
                        $languages .= $lang.' ('.ucwords(strtolower($skill)).'), ';
                    } else {
                        $languages .= $lang.', ';
                    }
                }

                $person = new Person();
                $person->addAttribute('first-name', $user['first_name']);
                $person->addAttribute('last-name', $user['last_name']);
                $person->addAttribute('wants', $user['wants']);
                $person->addAttribute('languages', $languages?$languages:"-");
                $person->addAttribute('picture', $user['photo_urls']['size_128x128']);
                $person->addAttribute('birthday', $user['birth_date']['month'].'/'.$user['birth_date']['day'].'/'.$user['birth_date']['year']);
                $person->addAttribute('company', $user['professional_experience']['primary_company']['name']);
                $person->addAttribute('job-title', $user['professional_experience']['primary_company']['title']);
                $person->addAttribute('company-start', $user['professional_experience']['primary_company']['begin_date']);

                // True or False
                $person->addAttribute('business_address', is_array($user['business_address']));
                $person->addAttribute('private_address', is_array($user['private_address']));
                $person->addAttribute('email', $user['active_email'] != null);
                $person->addAttribute('phone', $user['private_address']['phone'] != null);
                $person->addAttribute('mobile', $user['private_address']['mobile_phone'] != null);
                $person->addAttribute('fax', $user['private_address']['fax'] != null);

                $person->addAttribute('url', $user['permalink']);
                $person->addAttribute('resource', 'xing');

                $findings['profiles'][] = $person;
            }

            $merger = new Merger();
            $merger->addFindings($findings);

            return redirect('/api/xing/'.time());
        }
    }
}
