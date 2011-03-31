<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\GithubBundle\Manager;

use IHQS\GithubBundle\Model\UserInterface;

interface UserManagerInterface
{
    function findOneByGitId($gitId);
    
    function findOneByLogin($login);
    
    function createUser($data = null);
    
    function updateAccount($name);
    
    function import(UserInterface $user, array $data = array());
    
    function importId(UserInterface $user, $value);
    
    function importCreatedAt(UserInterface $user, $value);
    
    function importOwnedPrivateRepoCount(UserInterface $user, $value);
    
    function importTotalPrivateRepoCount(UserInterface $user, $value);
    
    function getClass();
}