<?php

namespace App\Libraries\Api;

use Illuminate\Http\Request;

class XingApi {

    public function requestXingProfile(Request $request, $userId)
    {
        // get data from request
        $token  = $request->get('oauth_token');
        $verify = $request->get('oauth_verifier');

        // get xing service
        $xing = \OAuth::consumer('Xing');

        // check if code is valid

        // if code is provided get user data and sign in
        if ( ! is_null($token) && ! is_null($verify))
        {
            // This was a callback request from xing, get the token
            $token = $xing->requestAccessToken($token, $verify);

            // Send a request with it
            $result = json_decode($xing->request('/users/'.$userId), true);

            //Var_dump
            //display whole array.
            dd($result);
        }
        // if not ask for permission first
        else
        {
            // get request token
            $reqToken = $xing->requestRequestToken();

            // get Authorization Uri sending the request token
            $url = $xing->getAuthorizationUri(['oauth_token' => $reqToken->getRequestToken()]);

            // return to xing login url
            return (string) $url;
        }
    }
}