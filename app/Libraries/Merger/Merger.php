<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 28.10.15
 * Time: 11:34
 */

namespace App\Libraries\Merger;


class Merger
{
    private $_findings;

    /**
     * Merger constructor.
     * @internal param $_findings
     */
    public function __construct()
    {
        $this->_findings['websites']  = [];
        $this->_findings['profiles']  = [];
        $this->_findings['emails']    = [];
        $this->_findings['locations'] = [];
    }


    /**
     * @return mixed
     */
    public function getFindings()
    {
        return $this->_findings;
    }

    public function addFindings($findings) {
        $this->_findings = array_merge_recursive($this->_findings, $findings);
        return $this;
    }
}