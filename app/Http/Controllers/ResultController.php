<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class ResultController extends Controller
{

    public function people()
    {
        $results = Session::get('findings');
        $categories = [];
        if(is_array($results)) {
            foreach($results['profiles'] as $profile) {
                $keys = array_keys($profile->getAttributes());
                $categories = array_merge($categories, $keys);
                $categories = array_unique($categories);
            }
        }
        return view('result.people', compact('results', 'categories'));
    }

    public function mail()
    {
        $results = Session::get('findings');
        return view('result.mail', compact('results'));
    }

    public function location()
    {
        $results = Session::get('findings');
        return view('result.location', compact('results'));
    }

    public function website()
    {
        $results = Session::get('findings');
        return view('result.website', compact('results'));
    }
}
