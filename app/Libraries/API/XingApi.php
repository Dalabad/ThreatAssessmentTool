<?php

namespace App\Libraries\Api;

use Illuminate\Http\Request;

class XingApi {

    public function loginWithXing(Request $request)
    {
        // get data from request
        $token  = $request->get('oauth_token');
        $verify = $request->get('oauth_verifier');

        // get twitter service
        $xing = \OAuth::consumer('Xing');

        // check if code is valid

        // if code is provided get user data and sign in
        if ( ! is_null($token) && ! is_null($verify))
        {
            // This was a callback request from twitter, get the token
            $token = $xing->requestAccessToken($token, $verify);

            // Send a request with it
            $result = json_decode($xing->request('/users/me'), true);

            $message = 'Your unique Twitter user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            echo $message. "<br/>";

            //Var_dump
            //display whole array.
            dd("Result: ".$result);
        }
        // if not ask for permission first
        else
        {
            // get request token
            $reqToken = $xing->requestRequestToken();

            // get Authorization Uri sending the request token
            $url = $xing->getAuthorizationUri(['oauth_token' => $reqToken->getRequestToken()]);

            // return to xing login url
            return redirect((string) $url);
        }
    }
}