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
    public static function crawl($url) {
        $html = CurlRequest::getHTML($url);

        return LinkedInCrawler::analyze($html);
    }

    private static function analyze($html) {
        $dom = HtmlDomParser::str_get_html( $html );
        $person = new Person();

        try {
            $fullName = $dom->find('span.full-name', 0)->plaintext;
            $explodedName = explode(' ', $fullName);
            $firstName = $explodedName[0];
            $lastName = $explodedName[1];

            $jobTitleAndCompany = $dom->find('#headline .title', 0)->plaintext;
            $explodedTitle = preg_split( "/ (@|at|bij|bei) /", $jobTitleAndCompany );
            $jobTitle = $explodedTitle[0];
            if(isset($explodedTitle[1])) {
                $companyName = $explodedTitle[1];
                $person->addAttribute('company', $companyName);
            }

            $location = $dom->find('#location .locality', 0)->plaintext;
            $industry = $dom->find('#location .industry', 0)->plaintext;
            $site = $dom->find('#overview-summary-websites a', 0);
            if(isset($site)) {
                $website = $site->href;
                $person->addAttribute('website', $website);
            }

            $person->addAttribute("first-name", $firstName)
                ->addAttribute('last-name', $lastName)
                ->addAttribute('job-title', $jobTitle)
                ->addAttribute('location', $location)
                ->addAttribute('industry', $industry);

        } catch(ErrorException $e) {}

        return $person;
    }

}