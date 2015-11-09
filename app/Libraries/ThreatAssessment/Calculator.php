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
                return 100/$this->_companyInformation['companyEmployeeCount']*$counter;
            case 'private_locations':
            case 'company_locations':
                if(isset($this->_companyInformation['companyLocation']))
                    return min(100, number_format($this->_companyInformation['companyLocation']*20,2));
                else
                    return 0;
            case 'friends':
                if(isset($this->_companyInformation['socialAccounts']))
                    return min(100, $this->_companyInformation['socialAccounts']);
                else
                    return 0;
            case 'personal_information':
                return number_format(100/$this->_companyInformation['companyEmployeeCount']*count($this->_findings['profiles']),2);
            case 'email':
                $counter = 0;
                foreach($this->_findings['profiles'] as $profile) {
                    $attr = $profile->getAttributes();
                    if(isset($attr['email'])) {
                        $counter++;
                    }
                }
                return number_format(100/$this->_companyInformation['companyEmployeeCount']*(count($this->_findings['emails'])+$counter),2);
            case 'messenger':
                $counter = 0;
                foreach($this->_findings['profiles'] as $profile) {
                    $attr = $profile->getAttributes();
                    if(isset($attr['messenger'])) {
                        $counter++;
                    }
                }
                return number_format(100/$this->_companyInformation['companyEmployeeCount']*$counter, 2);
            case 'lingo':
                if(isset($this->_companyInformation['companyLingo']))
                    return min(100, number_format($this->_companyInformation['companyLingo']*33,2));
                else
                    return 0;
            case 'websites':
                return min(100, number_format(count($this->_findings['websites'])*5,2));
            case 'security_measure':
                if(isset($this->_companyInformation['companySecurity']))
                    return $this->_companyInformation['companySecurity'];
                else
                    return 0;
            case 'software':
                if(isset($this->_companyInformation['companySoftware']))
                    return $this->_companyInformation['companySoftware'];
                else
                    return 0;
            case 'network':
                if(isset($this->_companyInformation['companyNetwork']))
                    return $this->_companyInformation['companyNetwork'];
                else
                    return 0;
            case 'organization':
                $counter = 0;
                foreach($this->_findings['profiles'] as $profile) {
                    $attr = $profile->getAttributes();
                    if(isset($attr['job-title'])) {
                        $counter++;
                    }
                }
                return min(100, number_format(100/$this->_companyInformation['companyEmployeeCount']*$counter,2));
            case 'special_knowledge':
                return number_format(100/$this->_companyInformation['companyEmployeeCount']*count($this->_findings['profiles']),2);
            case 'new_employee':
                return number_format(100/$this->_companyInformation['companyEmployeeCount']*count($this->_findings['profiles']),2);
            default:
                return 0;
        }
    }

}