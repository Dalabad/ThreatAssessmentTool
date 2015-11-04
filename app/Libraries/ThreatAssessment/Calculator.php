<?php

/**
 * Created by IntelliJ IDEA.
 * User: Daniel
 * Date: 11/3/2015
 * Time: 2:17 PM
 */

namespace App\Libraries\ThreatAssessment;

class Calculator
{

    private $_findings = null;

    /**
     * Calculator constructor.
     */
    public function __construct($findings)
    {
        $this->_findings = $findings;
    }

    public function calculateThreat($attackType) {

    }

}