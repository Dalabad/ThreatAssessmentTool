<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:34
 */

namespace App\Libraries\Crawler;

use App\Libraries\Requests\CurlRequest;
use App\Models\Person;
use Sunra\PhpSimple\HtmlDomParser;

class XingCrawler
{
    public static function crawl($url) {
        $html = CurlRequest::getHTML($url);

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