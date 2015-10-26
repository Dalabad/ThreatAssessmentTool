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

class Coordinates
{
    public static function convertLongitudeLatitudeToName($longitude, $latitude) {
        $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false";
        $html = CurlRequest::getHTML($url);

        $array = Parser::json($html);

        if(!isset($array['results'][0]['formatted_address']))
            return;

        return $array['results'][0]['formatted_address'];
    }

    public static function convertCoordinatesToName($coordinates) {

        $coords = explode(", ",$coordinates);
        $longitude = $coords[0];
        $latitude = $coords[1];

        return Coordinates::convertLongitudeLatitudeToName($longitude, $latitude);
    }

}
