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

        $name = $dom->find('span.full-name', 0);
        if(isset($name)) {
            $fullName = $name->plaintext;
            $explodedName = explode(' ', $fullName);
            $firstName = $explodedName[0];
            $lastName = $explodedName[1];

            $person->addAttribute("first-name", $firstName)
                ->addAttribute('last-name', $lastName);
        }

        $jobTitleAndCompany = $dom->find('#headline .title', 0);
        if(isset($jobTitleAndCompany)) {
            $explodedTitle = preg_split( "/ (@|at|bij|bei) /", $jobTitleAndCompany->plaintext );
            $jobTitle = $explodedTitle[0];
            if(isset($explodedTitle[1])) {
                $companyName = $explodedTitle[1];
                $person->addAttribute('company', $companyName);
            }
            $person->addAttribute('job-title', $jobTitle);
        }

        $location = $dom->find('#location .locality', 0);
        if(isset($location)) {
            $person->addAttribute('location', $location->plaintext);
        }

        $industry = $dom->find('#location .industry', 0);
        if(isset($industry)) {
            $person->addAttribute('industry', $industry->plaintext);
        }


//        $site = $dom->find('#overview-summary-websites a', 0);
//        if(isset($site)) {
//            $site = $dom->find('#overview-summary-websites a', 0);
//            $website = $site->href;
//            $person->addAttribute('website', $website);
//        }

        return $person;
    }

}