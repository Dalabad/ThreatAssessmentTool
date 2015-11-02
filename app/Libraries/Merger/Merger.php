<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 28.10.15
 * Time: 11:34
 */

namespace App\Libraries\Merger;


use Illuminate\Support\Facades\Session;

class Merger
{
    private $_findings;

    /**
     * Merger constructor.
     * @internal param $_findings
     */
    public function __construct()
    {
        if(!Session::has('findings')) {
            $this->_findings['websites']  = [];
            $this->_findings['profiles']  = [];
            $this->_findings['emails']    = [];
            $this->_findings['locations'] = [];
        } else {
            $this->_findings = Session::get('findings');
        }
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

        $this->removeDuplicates();

        Session::put('findings', $this->_findings);
        return $this;
    }

    public function removeDuplicates()
    {
        $this->_findings['websites'] = array_unique($this->_findings['websites']);
        $this->_findings['profiles'] = array_unique($this->_findings['profiles']);
        $this->_findings['emails'] = array_unique($this->_findings['emails']);
        $this->_findings['locations'] = array_unique($this->_findings['locations']);
    }
}