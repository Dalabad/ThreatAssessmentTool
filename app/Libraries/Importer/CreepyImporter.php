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

    public function import($file)
    {
        $this->findings['locations'] = [];

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
                ->setDescription( $placemark['description'] )
                ->setName( CoordinatesConverter::convertCoordinatesToName( $placemark['Point']['coordinates'] ));
            $this->findings['locations'][] = $location;
        }
    }
}