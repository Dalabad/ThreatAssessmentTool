<?php

namespace App\Libraries\Api;

use App\Libraries\Requests\CurlRequest;
use Illuminate\Http\Request;

class XingApi {

    private $_token;
    private $_verify;
    private $_service;

    /**
     * XingApi constructor.
     * @param $_token
     * @param $_verify
     */
    public function __construct($_token, $_verify)
    {
        $this->_token = $_token;
        $this->_verify = $_verify;

        // get xing service
        $this->_service = \OAuth::consumer('Xing');
    }

    public function requestRequestToken() {
        // get request token
        $reqToken = $this->_service->requestRequestToken();

        // get Authorization Uri sending the request token
        $url = $this->_service->getAuthorizationUri(['oauth_token' => $reqToken->getRequestToken()]);

        // return to xing login url
        return (string) $url;
    }


    public function requestXingProfiles($userIds)
    {
        // if code is provided get user data and sign in
        if (is_null($this->_token) || is_null($this->_verify))
        {
            $this->requestRequestToken();
        } else {
            // This was a callback request from xing, get the token
            $token = $this->_service->requestAccessToken($this->_token, $this->_verify);

            // Send a request with it
            $result = json_decode($this->_service->request('/users/'.$userIds), true);

            return $result;
        }

    }
}