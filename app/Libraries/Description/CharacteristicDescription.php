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
    /**
     * Returns a description for a given characteristic
     *
     * @param $characteristic
     * @return array
     */
    public function getText($characteristic)
    {
        switch ($characteristic) {
            case 'phone':
                return ['title' => 'Telephone Number', 'description' => 'Telephone numbers of possible victims are a direct communication channel. Attackers can call/message a victim or use the contact information for other purposes.'];
            case 'private_locations':
                return ['title' => 'Private Locations', 'description' => 'The locations employees go to, are relevant to know for baiting or impersonation. Attackers can gather additional information on such places or lay out bait to trick employees.'];
            case 'company_locations':
                return ['title' => 'Company Locations', 'description' => 'Company locations are important to know in order to convince employees of the attackers persona. Attackers can find the easiest location to attack or the correct location for the targeted department.'];
            case 'friends':
                return ['title' => 'Friends', 'description' => 'Tons of information on victims can be gathered on social media platforms. Even if the victim itself did not publish any information, maybe some friends did and mentioned the employee.'];
            case 'personal_information':
                return ['title' => 'Personal Information', 'description' => 'The more personal information the attacker has on a person, the more convincing a social engineering attack or impersonation can be performed.'];
            case 'email':
                return ['title' => 'E-Mail', 'description' => 'E-mail addresses of possible victims are a direct communication channel. Attackers can message the victim or even fake their own sender address and impersonate another person by using their address.'];
            case 'messenger':
                return ['title' => 'Messenger', 'description' => 'Instant messenger accounts are a direct communication channel. Most people use one or multiple messengers to stay in contact with co-workers and/or friends.'];
            case 'lingo':
                return ['title' => 'Company Lingo', 'description' => 'The most convincing knowledge one can have for all social engineering attacks is the company lingo. If the attacker knows how employees speak with each other, they can mimic the language and abbreviations.'];
            case 'websites':
                return ['title' => 'Websites', 'description' => 'Websites can be very resourceful. From the server locations, the websites content to other websites hosted on the same servers, the attacker can learn a lot about a company.'];
            case 'security_measure':
                return ['title' => 'Security Measures', 'description' => 'In order to get access to a location, it is essential to know about the security measures. Physical security is as important as technical security.'];
            case 'software':
                return ['title' => 'Software', 'description' => 'If the attacker wants to access software or impersonates a tech support, he needs to know the software beforehand. This includes the user interface as well as the lingo used within the software.'];
            case 'network':
                return ['title' => 'Network', 'description' => 'Most social engineering attackers use someone on the inside to open a connection, which the attacker can use from the outside. In this case the attacker needs knowledge about the companies network.'];
            case 'organization':
                return ['title' => 'Organization', 'description' => 'The layout of an organization can help social engineers to find their way around. Using organization hierarchies for threatening employees that their superiors need something, can motivate employees to ignore security measures.'];
            case 'special_knowledge':
                return ['title' => 'Employees with Special Knowledge', 'description' => 'Employees with special knowledge are of special interest for attackers. Often only the person with special privileges can access certain data, which is relevant for the attacker.'];
            case 'new_employee':
                return ['title' => 'New Employees', 'description' => 'New Employees are mostly not that familiar with the company yet. Also they don\'t know all their colleagues yet, which makes it easy for attackers to impersonate co-workers and gain access.'];
            default:
                return ['title' => $characteristic, 'description' => 'Characteristic not found'];
        }
    }

}