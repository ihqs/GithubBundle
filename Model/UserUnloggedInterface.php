<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\IHQS\GithubBundle\Model;

interface UserUnloggedInterface
{
    function getId();
    
    function getGitId();
    
    function getLogin();
    
    function setLogin($login);
    
    function getEmail();
    
    function setEmail($email);
    
    function getName();
    
    function setName($name);
    
    function getType();
    
    function setType($type);
    
    function getPermission();
    
    function setPermission($permission);
    
    function getGravatarId();
    
    function setGravatarId($gravatarId);
    
    function getCompany();
    
    function setCompany($company);
    
    function getBlog();
    
    function setBlog($blog);
    
    function getCreatedAt();
    
    function setCreatedAt(\DateTime $date);
    
    function getLocation();
    
    function setLocation($location);
    
    function getPublicRepoCount();
    
    function setPublicRepoCount($count);
    
    function getFollowingCount();
    
    function setFollowingCount($count);
    
    function getFollowersCount();
    
    function setFollowersCount($count);
}