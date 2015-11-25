<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 26.10.15
 * Time: 16:48
 */

namespace App\Libraries\Requests;


use Faker\Provider\UserAgent;

class CurlRequest
{
    public static function getHTML($url) {
        $agent = UserAgent::chrome();

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        curl_setopt($curl, CURLOPT_USERAGENT, $agent);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $html = curl_exec($curl);

        if (curl_error($curl))
            die(curl_error($curl));

        // Get the status code
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        dd($status, $html);

        curl_close($curl);
        return $html;
    }
}