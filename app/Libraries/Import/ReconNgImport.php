<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:16
 */

namespace App\Libraries\Import;


use App\Libraries\Crawler\LinkedInCrawler;
use App\Libraries\Crawler\XingCrawler;
use App\Models\Person;
use Symfony\Component\DomCrawler\Link;

class ReconNgImport extends Import
{

    public $findings;
    private $importedFile;

    public function import($file)
    {
        $this->findings["websites"]  = [];
        $this->findings["profiles"]  = [];
        $this->findings["emails"]    = [];
        $this->findings["locations"] = [];

        $this->importedFile = file_get_contents($file);

        $this->analyze();
        $this->analyzeProfiles();

        return $this->findings;
    }

    protected function analyze()
    {
        $json = json_decode($this->importedFile);

        if(property_exists($json, 'hosts')) {
            foreach($json->hosts as $host) {
                if(!in_array($host->host, $this->findings["websites"]))
                    $this->findings["websites"][] = $host->host;
            }
        }

        if(property_exists($json,'contacts')) {
            foreach($json->contacts as $contact) {
                $person = new Person();
                $person->addAttribute('resource', $contact->module)
                    ->addAttribute("first-name", $contact->first_name)
                    ->addAttribute('last-name', $contact->last_name)
                    ->addAttribute('job-title', $contact->title)
                    ->addAttribute('country', $contact->country)
                    ->addAttribute('region', $contact->region)
                    ->addAttribute('email', $contact->email);

                $this->findings["profiles"][] = $person;
                $this->findings["emails"][] = $contact->email;
            }
        }

        if(property_exists($json,'profiles')) {
            foreach($json->profiles as $profile) {
                $person = new Person();
                $person->addAttribute('resource', $profile->resource)
                       ->addAttribute('url', $profile->url);

                $this->findings["profiles"][] = $person;
            }
        }
    }

    private function analyzeProfiles()
    {
        if(count($this->findings['profiles']) <= 1)
            return;

        /* @var $person Person */
        foreach($this->findings['profiles'] as $index => $person) {
            $attributes = $person->getAttributes();

            if(!in_array($attributes['resource'], ['linkedin', 'xing']))
                continue;

            switch($attributes['resource']) {
                case 'linkedin':
                    $crawler = new LinkedInCrawler();
                    break;
                case 'xing':
                    $crawler = new XingCrawler();
                    break;
            }

            $findings = $crawler->crawl($attributes['url']);

            $this->findings['profiles'][$index] = $person->merge($findings);
        }
    }
}