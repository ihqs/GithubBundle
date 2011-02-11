<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\IHQS\GithubBundle\Model;

interface UserLoggedInterface
{
    function getTotalPrivateRepositories();
    
    function setTotalPrivateRepositories($totalRepos);
    
    function getTotalOwnedPrivateRepositories();
    
    function setTotalOwnedPrivateRepositories($totalRepos);
    
    function getCollaborators();
    
    function setCollaborators($collaborators);
    
    function getDiskUsage();
    
    function setDiskUsage($diskUsage);
    
    function getPlan();
    
    function setPlan(array $plan = array());
}