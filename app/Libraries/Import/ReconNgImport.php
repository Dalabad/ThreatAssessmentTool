<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:16
 */

namespace App\Libraries\Import;


class ReconNgImport extends Import
{

    public $findings;
    private $importedFile;

    public function import($file)
    {
        $this->importedFile = file_get_contents($file);

        $this->analyze();

        return $this->findings;
    }

    protected function analyze()
    {
        $json = json_decode($this->importedFile);

        foreach($json->person as $person) {
            $this->findings["people"] = $person;
            $this->findings["email"] = $person->email;
        }
        foreach($json->locations as $location) {
            $this->findings["locations"] = $location;
        }
        foreach($json->websites as $website) {
            $this->findings["websites"] = $website;
        }
    }
}