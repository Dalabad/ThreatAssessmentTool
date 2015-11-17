<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:16
 */

namespace App\Libraries\Importer;


use App\Libraries\Converter\CoordinatesConverter;
use App\Models\Location;
use Nathanmac\Utilities\Parser\Facades\Parser;

class CreepyImporter extends Importer
{

    public $findings;
    private $importedFile;

    /**
     * Import and then analyze a file from the Cree.py tool
     *
     * @param Exported $file
     * @return mixed
     */
    public function import($file)
    {
        $this->findings['locations'] = [];

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

        foreach($array['Document']['Placemark'] as $placemark) {
            $coordinates = $placemark['Point']['coordinates'];
            $coords = explode(", ",$coordinates);
            $latitude = $coords[1];
            $longitude = $coords[0];

            $location = new Location();
            $location->setTimestamp( $placemark['name'] )
                ->setCoordinates( $latitude.", ".$longitude )
                ->setDescription( $placemark['description'] )
                ->setName( CoordinatesConverter::convertLongitudeLatitudeToName($latitude, $longitude));
            $this->findings['locations'][] = $location;
        }
    }
}