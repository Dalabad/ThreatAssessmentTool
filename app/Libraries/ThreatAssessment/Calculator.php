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
     *
     * @param $companyInformation
     * @param $findings
     */
    public function __construct($companyInformation, $findings)
    {
        $this->_companyInformation = $companyInformation;
        $this->_findings = $findings;
    }

    /**
     * Return relevant characteristics for a given attack type
     * with their current threat values, based on the gathered information
     *
     * @param $attackType
     * @return array
     */
    public function getCharacteristicsWithThreatValue($attackType) {
        $characteristics = AttackTypes2Characteristics::getCharacteristics($attackType);
        foreach($characteristics as $index => $characteristic) {
            $characteristics[$index]['value'] = $this->calculateValue($characteristic['slag']);
        }

        return $characteristics;
    }

    /**
     * Calculates the overall threat value for the company
     * based on the gathered information
     *
     * @param $attackType
     * @return string
     */
    public function calculateThreat($attackType) {
        $characteristics = $this->getCharacteristicsWithThreatValue($attackType);
        $priorities = $this->getPriorities($attackType);

        $realThreat = 0;
        $maxThreat = 0;
        foreach($characteristics as $characteristic) {
            $maxThreat = $maxThreat + $priorities[$characteristic['slag']];
            $realThreat = $realThreat + $priorities[$characteristic['slag']] * $characteristic['value'];
        }
        $maxThreat = $maxThreat * 100;

        $threatValue = 100/$maxThreat*$realThreat;

        return number_format($threatValue,0);
    }

    /**
     * Calculate the threat value for a given characteristic
     * based on the gathered information
     *
     * @param $characteristic
     * @return int|mixed|string
     */
    private function calculateValue($characteristic) {
        switch ($characteristic) {
            case 'phone':
                if(!isset($this->_findings['profiles']) || !count($this->_findings['profiles'])) {
                    return 0;
                }
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
                    return min(100, $this->_companyInformation['socialAccounts']*1.3);
                else
                    return 0;
            case 'personal_information':
                return number_format(100/$this->_companyInformation['companyEmployeeCount']*(count($this->_findings['profiles'])+$this->_companyInformation['socialAccounts']),2);
            case 'email':

                if(!isset($this->_findings['profiles']) || !count($this->_findings['profiles'])) {
                    return 0;
                }
                $counter = 0;
                foreach($this->_findings['profiles'] as $profile) {
                    $attr = $profile->getAttributes();
                    if(isset($attr['email'])) {
                        $counter++;
                    }
                }
                return number_format(100/$this->_companyInformation['companyEmployeeCount']*(count($this->_findings['emails'])+$counter),2);
            case 'messenger':
                if(!isset($this->_findings['profiles']) || !count($this->_findings['profiles'])) {
                    return 0;
                }
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
                if(!isset($this->_findings['profiles']) || !count($this->_findings['profiles'])) {
                    return 0;
                }
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

    /**
     * Get the priorities for all characteristics relevant for a given attack type
     *
     * @param $attackType
     * @return array
     */
    private function getPriorities($attackType) {

        $PRIORITY_LOW    = 1;
        $PRIORITY_MEDIUM = 2;
        $PRIORITY_HIGH   = 3;

        switch($attackType) {
            case 'phishing':
                $priorities = [
                    'phone'                 => $PRIORITY_HIGH,
                    'email'                 => $PRIORITY_HIGH,
                    'messenger'             => $PRIORITY_MEDIUM,
                    'lingo'                 => $PRIORITY_MEDIUM,
                    'personal_information'  => $PRIORITY_MEDIUM,
                    'private_locations'     => $PRIORITY_LOW,
                    'friends'               => $PRIORITY_LOW,
                    'websites'              => $PRIORITY_LOW
                ];
                break;
            case 'baiting':
                $priorities = [
                    'company_locations'     => $PRIORITY_HIGH,
                    'organization'          => $PRIORITY_HIGH,
                    'software'              => $PRIORITY_MEDIUM,
                    'security_measure'      => $PRIORITY_MEDIUM,
                    'network'               => $PRIORITY_LOW
                ];
                break;
            case 'impersonation':
                $priorities = [
                    'lingo'                 => $PRIORITY_HIGH,
                    'special_knowledge'     => $PRIORITY_HIGH,
                    'new_employee'          => $PRIORITY_HIGH,
                    'personal_information'  => $PRIORITY_MEDIUM,
                    'security_measure'      => $PRIORITY_MEDIUM,
                    'company_locations'     => $PRIORITY_MEDIUM,
                    'private_locations'     => $PRIORITY_MEDIUM,
                    'friends'               => $PRIORITY_LOW
                ];
                break;
            default:
                $priorities = [];
                break;
        }

        return $priorities;
    }

}