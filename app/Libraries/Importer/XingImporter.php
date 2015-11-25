<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:16
 */

namespace App\Libraries\Importer;

use App\Libraries\Crawler\XingCrawler;
use App\Libraries\Requests\CurlRequest;
use App\Models\Person;
use Nathanmac\Utilities\Parser\Facades\Parser;
use Sunra\PhpSimple\HtmlDomParser;

class XingImporter extends Importer
{

    public  $findings;
    private $importedFile;
    private $companyName;

    /**
     * Import Profiles from a given xing url
     *
     * @param Exported $url
     * @return mixed
     */
    public function import($url)
    {
        $this->findings['profiles']  = [];

        $website = CurlRequest::getHTML($url);
        $dom = HtmlDomParser::str_get_html( $website );
        if(method_exists($dom, 'find')){
            $organizationName = $dom->find('h1.organization-name', 0);
            if(method_exists($organizationName, 'plaintext')) {
                $this->companyName = $organizationName->plaintext;
            } else {
                $this->companyName = "";
            }
        }

        $this->importedFile = $this->gatherHtmlCode($url);

        $this->analyzeProfiles();

        return $this->findings;
    }

    /**
     * Generate the html code to include all employees
     *
     * NOTE: Limited to 100 per Letter by the code, to avoid
     * very long waiting times
     *
     * @param $mainUrl
     * @return string
     */
    protected function gatherHtmlCode($mainUrl) {
        $letters = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $sourceCode = "";

        foreach($letters as $letter) {
            $url = $mainUrl.'/employees.json?filter=all&letter='.$letter.'&limit=100&offset=0&_='.time();
            $html = CurlRequest::getHTML($url);
            $json = Parser::json($html);

            if(isset($json['contacts'][$letter]['html'])) {
                foreach($json['contacts'][$letter]['html'] as $code) {
                    $sourceCode .= $code;
                }
            }

            $this->importedFile = $sourceCode;

            // Analyse current letter
            $this->analyze();

            // Reset sourceCode for next letter
            $sourceCode = "";
        }
    }

    /**
     * Analyze the html code for relevant information
     */
    protected function analyze() {
        $dom = HtmlDomParser::str_get_html( $this->importedFile );

        if(method_exists($dom, 'find')) {
            foreach($dom->find('a.user-name-link') as $element) {
                $url = 'https://www.xing.com'.$element->href;
                $url = substr($url,0,strpos($url, '/',29));

                $person = new Person();
                $person->addAttribute('resource', 'xing')
                       ->addAttribute('url', $url)
                       ->addAttribute('company', $this->companyName);

                $this->findings['profiles'][] = $person;
            }
        }
    }

    /**
     * Analyze all profiles and add the information
     * to the findings
     */
    protected function analyzeProfiles()
    {
        foreach($this->findings['profiles'] as $index => $profile) {
            $attributes = $profile->getAttributes();

            $crawler = new XingCrawler();
            $findings = $crawler->crawl($attributes['url']);

            $this->findings['profiles'][$index] = $profile->merge($findings);
        }
    }
}