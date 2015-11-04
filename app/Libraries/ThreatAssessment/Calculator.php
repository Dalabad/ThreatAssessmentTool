<?php

/**
 * Created by IntelliJ IDEA.
 * User: Daniel
 * Date: 11/3/2015
 * Time: 2:17 PM
 */

namespace App\Libraries\ThreatAssessment;

use App\Libraries\Mapper\AttackTypes2Characteristics;

class Calculator
{

    private $_findings = null;
    private $_companyInformation = null;

    /**
     * Calculator constructor.
     */
    public function __construct($companyInformation, $findings)
    {
        $this->_companyInformation = $companyInformation;
        $this->_findings = $findings;
    }

    public function calculateThreat($attackType) {
        $characteristics = AttackTypes2Characteristics::getCharacteristics($attackType);
        foreach($characteristics as $index => $characteristic) {
            $characteristics[$index]['value'] = $this->calculateValue($characteristic['slag']);
        }

        return $characteristics;
    }

    private function calculateValue($characteristic) {
        switch ($characteristic) {
            case 'phone':
                $counter = 0;
                foreach($this->_findings['profiles'] as $profile) {
                    $attr = $profile->getAttributes();
                    if(isset($attr['phone'])) {
                        $counter++;
                    }
                }
                return $this->_companyInformation['companyEmployeeCount']/100*$counter;
            case 'private_locations':
            case 'company_locations':
                return count($this->_findings['locations']);
            case 'friends':
                return 0; //TODO: calculate
            case 'personal_information':
                return $this->_companyInformation['companyEmployeeCount']/100*count($this->_findings['profiles']);
            case 'email':
                $counter = 0;
                foreach($this->_findings['profiles'] as $profile) {
                    $attr = $profile->getAttributes();
                    if(isset($attr['email'])) {
                        $counter++;
                    }
                }
                return $this->_companyInformation['companyEmployeeCount']/100*(count($this->_findings['emails'])+$counter);
            case 'messenger':
                $counter = 0;
                foreach($this->_findings['profiles'] as $profile) {
                    $attr = $profile->getAttributes();
                    if(isset($attr['messenger'])) {
                        $counter++;
                    }
                }
                return $this->_companyInformation['companyEmployeeCount']/100*$counter;
            case 'lingo':
                return 0; //TODO: calculate
            case 'websites':
                return count($this->_findings['websites']);
            case 'security_measure':
                return 0; //TODO: calculate
            case 'software':
                return 0; //TODO: calculate
            case 'network':
                return 0; //TODO: calculate
            case 'organization':
                return $this->_companyInformation['companyEmployeeCount']/100*count($this->_findings['profiles']);
            case 'special_knowledge':
                return $this->_companyInformation['companyEmployeeCount']/100*count($this->_findings['profiles']);
            case 'new_employee':
                return $this->_companyInformation['companyEmployeeCount']/100*count($this->_findings['profiles']);
            default:
                return 0;
        }
    }

}