<?php
/**
 * Created by IntelliJ IDEA.
 * User: Daniel
 * Date: 11/3/2015
 * Time: 2:19 PM
 */

namespace App\Libraries\Mapper;


use App\Libraries\Description\CharacteristicDescription;

class AttackTypes2Characteristics
{

    public static function getCharacteristics($attackType) {
        switch($attackType) {
            case 'phishing':
                $characteristics = ['phone', 'private_locations', 'friends', 'personal_information', 'email', 'messenger', 'lingo', 'websites'];
                break;
            case 'baiting':
                $characteristics = ['security_measure', 'company_locations', 'software', 'network', 'organization'];
                break;
            case 'impersonation':
                $characteristics = ['private_locations', 'company_locations', 'friends', 'personal_information', 'special_knowledge', 'new_employee', 'lingo', 'security_measure'];
                break;
            default:
                $characteristics = [];
                break;
        }
        $fullArray = [];

        foreach($characteristics as $characteristic) {
            $descriptions = new CharacteristicDescription();
            $text = $descriptions->getText($characteristic);
            $fullArray[] = array_merge(['slag' => $characteristic], $text);
        }
        return $fullArray;
    }

}