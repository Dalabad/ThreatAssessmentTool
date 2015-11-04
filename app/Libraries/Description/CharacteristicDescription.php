<?php
/**
 * Created by IntelliJ IDEA.
 * User: Daniel
 * Date: 11/4/2015
 * Time: 3:02 PM
 */

namespace App\Libraries\Description;


class CharacteristicDescription
{
    public function getText($characteristic)
    {
        switch ($characteristic) {
            case 'phone':
                return ['title' => 'Telephone Number', 'description' => 'Gather the telephone numbers of possible victims in order to get a direct communication channel.'];
            case 'private_locations':
                return ['title' => 'Private Locations', 'description' => 'The locations employees go to, are relevant to know for baiting or impersonation.'];
            case 'company_locations':
                return ['title' => 'Company Locations', 'description' => 'Company Locations are important to know in order to convince employees of the attackers persona.'];
            case 'friends':
                return ['title' => 'Friends', 'description' => 'Tons of information of victims can be gathered on social media. Even if the victim itself did not publish any information, maybe some friends did.'];
            case 'personal_information':
                return ['title' => 'Personal Information', 'description' => 'The more personal information the attacker has on a person, the more convincing a social engineering attack can be performed.'];
            case 'email':
                return ['title' => 'E-Mail', 'description' => 'Gather the e-mail addresses of possible victims in order to get a direct communication channel.'];
            case 'messenger':
                return ['title' => 'Messenger', 'description' => 'Find instant messenger accounts of possible victims in order to get a direct communication channel.'];
            case 'lingo':
                return ['title' => 'Company Lingo', 'description' => 'The most convincing knowledge one can have for all social engineering attacks is the company lingo. If the attacker know how employees speak with each other you can mimic the language.'];
            case 'websites':
                return ['title' => 'Websites', 'description' => 'Gathering information about the websites can be very resourceful. From the server locations, the websites content, other websites hosted on the same servers, ... there is a lot information.'];
            case 'security_measure':
                return ['title' => 'Security Measures', 'description' => 'In order to get access to a location, it is essential to know about the security measures.'];
            case 'software':
                return ['title' => 'Software', 'description' => 'If the attacker wants to access software or wants to use direct someone through the software, then it is essential to know the software beforehand. This includes the user interface as well as the lingo used within the software.'];
            case 'network':
                return ['title' => 'Network', 'description' => 'Most social engineering attackers use someone on the inside to open a connection, which the attacker can use from the outside. In this case the attacker needs knowledge about the network.'];
            case 'organization':
                return ['title' => 'Organization', 'description' => 'The layout of an organization can help social engineers to find their way around. Using organization hierarchies for threatening employees that their superiors need something, can motivcate employees to ignore security measures.'];
            case 'special_knowledge':
                return ['title' => 'Employees with Special Knowledge', 'description' => 'Employees with special knowledge are of special interest for attackers. Often only the person with special privileges can access certain data, which is relevant for the attacker.'];
            case 'new_employee':
                return ['title' => 'New Employees', 'description' => 'New Employees are not that familiar with the company yet. Also they dont know all their colleagues yet, which makes it easy for attackers to impersonate co-workers and gain access.'];
            default:
                return ['title' => $characteristic, 'description' => 'Characteristic not found'];
        }
    }

}