<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\GithubBundle\Manager;

use Bundle\IHQS\GithubBundle\Model\OrganizationInterface;

interface OrganizationManagerInterface
{
    function findOneByName($name);
    
    function createOrganization($data = null);

    function updateAccount($name);
    
    function import(OrganizationInterface $organization, array $data = array());
    
    function importId(OrganizationInterface $commit, $value);
    
    function importTeams(OrganizationInterface $commit, array $value = array());
    
    function importUsers(OrganizationInterface $commit, array $value = array());

    function getClass();
}