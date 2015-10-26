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
use App\Models\Location;
use App\Models\Person;
use Nathanmac\Utilities\Parser\Facades\Parser;
use Symfony\Component\DomCrawler\Link;

class CreepyImport extends Import
{

    public $findings;
    private $importedFile;

    public function import($file)
    {
        $this->findings["coordinates"] = [];

        $this->importedFile = file_get_contents($file);

        $this->analyze();

        return $this->findings;
    }

    protected function analyze()
    {
        $array = Parser::xml($this->importedFile);

        foreach($array['Document']['Placemark'] as $placemark) {
            $location = new Location();
            $location->setTimestamp( $placemark['name'] )
                ->setCoordinates( $placemark['Point']['coordinates'] )
                ->setDescription( $placemark['description'] );
            $this->findings['coordinates'][] = $location;
        }
    }
}