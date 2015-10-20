<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:34
 */

namespace App\Libraries\Crawler;

use App\Models\Person;
use Faker\Provider\UserAgent;
use Sunra\PhpSimple\HtmlDomParser;

class XingCrawler
{
    public static function crawl($url) {
        $agent = UserAgent::chrome();

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        curl_setopt($curl, CURLOPT_USERAGENT, $agent);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $html = curl_exec($curl);

        if (curl_error($curl))
            die(curl_error($curl));

        // Get the status code
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return $agent.$html;
        return XingCrawler::analyze($html);
    }

    private static function analyze($html) {
        $dom = HtmlDomParser::str_get_html( $html );
        $person = new Person();

        $fullName = $dom->find('h1.username', 0)->plaintext;
        $explodedName = explode(' ', $fullName);
        $firstName = $explodedName[0];
        $lastName = $explodedName[1];

        $jobTitle = $dom->find('.job-info .job-title', 0)->plaintext;

        $person->addAttribute("first-name", $firstName)
            ->addAttribute('last-name', $lastName)
            ->addAttribute('job-title', $jobTitle);

        return $person;
    }

}