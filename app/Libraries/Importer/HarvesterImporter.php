<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:16
 */

namespace App\Libraries\Importer;


use App\Libraries\Crawler\LinkedInCrawler;
use App\Libraries\Crawler\XingCrawler;
use App\Models\Person;
use Nathanmac\Utilities\Parser\Facades\Parser;

class HarvesterImporter extends Importer
{

    public $findings;
    private $importedFile;

    /**
     * Import and then analyze a TheHarvester file
     *
     * @param Exported $file
     * @return mixed
     */
    public function import($file)
    {
        $this->findings['websites']  = [];
        $this->findings['emails']    = [];

        $this->importedFile = file_get_contents($file);

        $this->analyze();

        return $this->findings;
    }

    /**
     * Analyze the files content for relevant information.
     * Adds the findings to the collection
     */
    protected function analyze()
    {
        $array = Parser::xml($this->importedFile);

        if(count($array['host'])) {
            foreach($array['host'] as $host) {
                $this->findings["websites"][] = $host;
            }
        }

        if(count($array['email'])) {
            foreach($array['email'] as $email) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->findings["emails"][] = $email;
                }
            }
        }

    }

}