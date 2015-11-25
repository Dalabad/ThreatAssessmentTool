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
use ErrorException;
use Sunra\PhpSimple\HtmlDomParser;

class LinkedInCrawler
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
        return self::analyze($html);
    }

    /**
     * Analyzes html and extracts all relevant information
     *
     * @param $html
     * @return Person
     */
    private static function analyze($html) {
        $person = new Person();
        $dom = HtmlDomParser::str_get_html( $html );

        if(!method_exists($dom, 'find')) {
            return $person;
        }

        $name = $dom->find('h1#name', 0);
        if(isset($name)) {
            $fullName = $name->plaintext;
            $explodedName = explode(' ', $fullName);
            $firstName = $explodedName[0];
            $lastName = $explodedName[1];

            $person->addAttribute("first-name", $firstName)
                ->addAttribute('last-name', $lastName);
        }

        $jobTitleAndCompany = $dom->find('p.title', 0);
        if(isset($jobTitleAndCompany)) {
            $explodedTitle = preg_split( "/ (@|at|bij|bei) /", $jobTitleAndCompany->plaintext );
            $jobTitle = $explodedTitle[0];
            if(isset($explodedTitle[1])) {
                $companyName = $explodedTitle[1];
                $person->addAttribute('company', $companyName);
            }
            $person->addAttribute('job-title', $jobTitle);
        }

        $location = $dom->find('span.locality', 0);
        if(isset($location)) {
            $person->addAttribute('location', $location->plaintext);
        }

        $industry = $dom->find('#location .industry', 0);
        if(isset($industry)) {
            $person->addAttribute('industry', $industry->plaintext);
        }

        return $person;
    }

}