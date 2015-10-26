<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:12
 */

namespace App\Libraries\Importer;


abstract class Importer
{

    /**
     * Import a file containing the results from a specific tool.
     * The file then gets parsed by the analyze method and returns the findings
     *
     * @param $file Exported results from a tool (json|xml)
     * @return mixed
     */
    abstract public function import($file);

    /**
     * Parses the imported file for its content and adds each finding to an array,
     * which will be returned to the import method.
     *
     * @return mixed
     */
    abstract protected function analyze();

}