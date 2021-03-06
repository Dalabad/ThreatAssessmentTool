<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:16
 */

namespace App\Libraries\Importer;


use App\Libraries\Crawler\LinkedInCrawler;
use App\Models\Person;
use Nathanmac\Utilities\Parser\Facades\Parser;

class ReconNgImporter extends Importer
{

    public $findings;
    private $importedFile;

    /**
     * Import and then analyze a reconNG file
     *
     * @param Exported $file
     * @return mixed
     */
    public function import($file)
    {
        $this->findings['websites']  = [];
        $this->findings['profiles']  = [];
        $this->findings['emails']    = [];

        $this->importedFile = file_get_contents($file);

        $this->analyze();
        $this->analyzeProfiles();

        return $this->findings;
    }

    /**
     * Analyze the files content for relevant information
     * Adds the findings to the collection
     */
    protected function analyze()
    {
        $array = Parser::json($this->importedFile);

        if(count($array['hosts'])) {
            foreach($array['hosts'] as $host) {
                if(!in_array($host['host'], $this->findings["websites"]))
                    $this->findings["websites"][] = $host['host'];
            }
        }

        if(count($array['contacts'])) {
            foreach($array['contacts'] as $contact) {
                $person = new Person();
                $person->addAttribute('resource', $contact['module'])
                    ->addAttribute("first-name", $contact['first_name'])
                    ->addAttribute('last-name', $contact['last_name'])
                    ->addAttribute('job-title', $contact['title'])
                    ->addAttribute('country', $contact['country'])
                    ->addAttribute('region', $contact['region'])
                    ->addAttribute('email', $contact['email']);

                $this->findings["profiles"][] = $person;
                if (filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
                    $this->findings["emails"][] = $contact['email'];
                }
            }
        }

        if(count($array['profiles'])) {
            foreach($array['profiles'] as $profile) {
                $person = new Person();
                $person->addAttribute('resource', $profile['resource'])
                       ->addAttribute('url', $profile['url']);

                $this->findings["profiles"][] = $person;
            }
        }
    }

    /**
     * Analyzes the gathered profile-urls and merges them with the
     * additional information gathered from those sites
     */
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
            }

            $findings = $crawler->crawl($attributes['url']);

            $this->findings['profiles'][$index] = $person->merge($findings);
        }
    }
}