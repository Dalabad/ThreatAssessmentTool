<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class ResultController extends Controller
{

    private $_emailCounter = null;
    /**
     * ResultController constructor.
     */
    public function __construct()
    {
        $findings = Session::get('findings');
        $count = count($findings['emails']);
        if(isset($findings['profiles'])) {
            foreach($findings['profiles'] as $profile) {
                $attributes = $profile->getAttributes();
                if(isset($attributes['email']))
                    $count++;
            }
        }
        $this->_emailCounter = $count;
    }

    public function people()
    {
        $mailCount = $this->_emailCounter;
        $results = Session::get('findings');
        $categories = [];
        if(is_array($results)) {
            foreach($results['profiles'] as $profile) {
                if(is_array($profile->getAttributes())) {
                    $keys = array_keys($profile->getAttributes());
                    $categories = array_merge($categories, $keys);
                    $categories = array_unique($categories);
                }
            }
        }
        array_forget($categories, array_search('picture',$categories) );
        return view('result.people', compact('results', 'categories', 'mailCount'));
    }

    public function mail()
    {
        $mailCount = $this->_emailCounter;
        $results = Session::get('findings');
        return view('result.mail', compact('results', 'mailCount'));
    }

    public function location()
    {
        $mailCount = $this->_emailCounter;
        $results = Session::get('findings');
        return view('result.location', compact('results', 'mailCount'));
    }

    public function website()
    {
        $mailCount = $this->_emailCounter;
        $results = Session::get('findings');
        return view('result.website', compact('results', 'mailCount'));
    }
}
