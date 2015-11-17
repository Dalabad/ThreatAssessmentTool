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
use Nathanmac\Utilities\Parser\Facades\Parser;

class XingCrawler
{

    /**
     * Returns the source code from a given url
     * and analyzes its content
     *
     * @param $url
     * @return Person
     */
    public static function crawl($url) {
        $html = CurlRequest::getHTML($url);
        $communicationChannels = CurlRequest::getHTML($url.'/load_upsell_data?_='.time());

        return self::analyze($html, $communicationChannels, $url);
    }

    /**
     * Analyzes html code and extracts all relevant information
     *
     * @param $html
     * @param $communicationChannels
     * @param $url
     * @return Person
     */
    private static function analyze($html, $communicationChannels, $url) {
        $dom = HtmlDomParser::str_get_html( $html );
        $person = new Person();

        $fullName = $dom->find('h1.username', 0);
        if(isset($fullName)) {
            $explodedName = explode(' ', $fullName->plaintext);
            $firstName = $explodedName[0];
            $lastName = $explodedName[1];

            $person->addAttribute("first-name", $firstName)
                ->addAttribute('last-name', $lastName);
        }

        $jobTitle = $dom->find('.job-info .job-title', 0);
        if(isset($jobTitle)) {
            $person->addAttribute('job-title', $jobTitle->plaintext);
        }

        $coms = Parser::json($communicationChannels);

        $person->addAttribute('phone', $coms['phone'] ? "Available" : "-")
            ->addAttribute('address', $coms['address'] ? "Available" : "-")
            ->addAttribute('email', $coms['email'] ? "Available" : "-")
            ->addAttribute('messenger', $coms['messenger'] ? "Available" : "-")
            ->addAttribute('fax', $coms['fax'] ? "Available" : "-")
            ->addAttribute('web', $coms['web'] ? "Available" : "-")
            ->addAttribute('resource', "xing")
            ->addAttribute('url', $url);

        return $person;
    }

}