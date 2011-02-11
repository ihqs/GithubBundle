<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\IHQS\GithubBundle\Model;

interface OrganizationInterface
{
    function getUser();
    
    function setUser(UserInterface $user);
    
    function getPublicMembers();
    
    function hasPublicMember(UserInterface $member);
    
    function addPublicMember(UserInterface $member);
    
    function removePublicMember(UserInterface $member);
    
    function getTeams();
    
    function hasTeam(OrganizationInterface $team);
    
    function addTeam(OrganizationInterface $team);
    
    function removeTeam(OrganizationInterface $team);
}