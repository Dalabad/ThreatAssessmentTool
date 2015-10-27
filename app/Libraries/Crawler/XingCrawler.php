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
    public static function crawl($url) {
        $html = CurlRequest::getHTML($url);

        $communicationChannels = CurlRequest::getHTML($url.'/load_upsell_data?_='.time());

        return XingCrawler::analyze($html, $communicationChannels);
    }

    private static function analyze($html, $communicationChannels) {
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

        $coms = Parser::json($communicationChannels);

        $person->addAttribute('phone', $coms['phone'])
            ->addAttribute('address', $coms['address'])
            ->addAttribute('email', $coms['email'])
            ->addAttribute('messenger', $coms['messenger'])
            ->addAttribute('fax', $coms['fax'])
            ->addAttribute('web', $coms['web']);

        return $person;
    }

}