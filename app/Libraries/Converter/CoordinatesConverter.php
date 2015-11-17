<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:12
 */

namespace App\Libraries\Converter;

use App\Libraries\Requests\CurlRequest;
use Nathanmac\Utilities\Parser\Facades\Parser;

class CoordinatesConverter
{
    /**
     * Returns a formatted address name for given coordinates
     *
     * @param $latitude
     * @param $longitude
     * @return formatted_address|null
     */
    public static function convertLongitudeLatitudeToName($latitude, $longitude) {
        $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false";
        $html = CurlRequest::getHTML($url);

        $array = Parser::json($html);

        if(!isset($array['results'][0]['formatted_address']))
            return null;

        return $array['results'][0]['formatted_address'];
    }

}
