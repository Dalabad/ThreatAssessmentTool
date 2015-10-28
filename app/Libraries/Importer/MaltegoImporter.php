<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:16
 */

namespace App\Libraries\Import;


use Nathanmac\Utilities\Parser\Facades\Parser;

class MaltegoImporter extends Importer
{

    public $findings;
    private $importedFile;

    public function import($file)
    {
        $this->_findings['websites']  = [];
        $this->_findings['profiles']  = [];
        $this->_findings['emails']    = [];
        $this->_findings['locations'] = [];

        $this->importedFile = file_get_contents($file);

        $this->analyze();

        return $this->findings;
    }

    protected function analyze()
    {
        $array = Parser::xml($this->importedFile)->get('graph');
        //die('<pre>'.var_dump($array));

        foreach($array['node'] as $node) {
            $entity = $node['data']['mtg:MaltegoEntity'];

            switch($entity['type']) {
                case "maltego.DNSName":
                    break;
                case "maltego.Domain":
                    break;
                case "maltego.EmailAddress":
                    $email = "";
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    }
                    break;
                case "maltego.link.transform-link":
                    break;
            }
        }
    }
}