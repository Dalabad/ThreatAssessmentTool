<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:16
 */

namespace App\Libraries\Import;


use App\Libraries\Importer\Importer;
use Nathanmac\Utilities\Parser\Facades\Parser;

class MaltegoImporter extends Importer
{

    public $_findings;
    private $_importedFile;

    /**
     * Import and then analyze a file from maltego
     *
     * @param \App\Libraries\Importer\Exported $file
     * @return mixed
     */
    public function import($file)
    {
        $this->_findings['websites']  = [];
        $this->_findings['profiles']  = [];
        $this->_findings['emails']    = [];
        $this->_findings['locations'] = [];

        $fileContent = file_get_contents($file);
        $fileContent = str_replace(
            [
                'version="1.1"', // Change Version to 1.0
                ' xmlns:mtg="http://maltego.paterva.com/xml/mtgx"', // Remove Schema
                'mtg:' // Remove Namespace
            ],
            [
                'version="1.0"',
                '',
                ''
            ],
            $fileContent
        );
        $this->_importedFile = Parser::xml($fileContent);

        $this->analyze();

        return $this->_findings;
    }

    /**
     * Analyze the files content for relevant information.
     * Adds the findings to the collection
     */
    protected function analyze()
    {
        foreach($this->_importedFile['graph']['node'] as $node) {
            $entity = $node['data'][0]['MaltegoEntity'];

            switch($entity['@attributes']['type']) {
                case "maltego.DNSName":
                    $this->_findings['websites'][] = $entity['Properties']['Property']['Value'];
                    break;
                case "maltego.Website":
                    $this->_findings['websites'][] = $entity['Properties']['Property'][0]['Value'];
                    break;
                case "maltego.Domain":
                    $this->_findings['websites'][] = $entity['Properties']['Property'][0]['Value'];
                    break;
                case "maltego.EmailAddress":
                    $email = $entity['Properties']['Property'][0]['Value'];
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $this->_findings['emails'][] = $email;
                    }
                    break;
            }
        }
    }
}