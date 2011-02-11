<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\IHQS\GithubBundle\Model;

interface RepositoryInterface
{
    function getType();
    
    function setType($type);
    
    function isPrivate();
    
    function setPrivate($private);
    
    function getOwner();
    
    function setOwner(UserInterface $owner);
    
    function getLanguage();
    
    function setLanguage($language);
    
    function getName();
    
    function setName($name);
    
    function getDescription();
    
    function setDescription($description);
    
    function getUrl();
    
    function setUrl($url);
    
    function getHomepage();
    
    function setHomepage($homepage);
    
    function getPushedAt();
    
    function setPushedAt(\DateTime $pushedAt);
    
    function getCreatedAt();
    
    function setCreatedAt(\DateTime $createdAt);
    
    function getScore();
    
    function setScore($score);
    
    function getSize();
    
    function setSize($size);
    
    function hasDownloads();
    
    function setHasDownloads($downloads);
    
    function hasWiki();
    
    function setHasWiki($wiki);
    
    function hasIssues();
    
    function setHasIssues($issues);
    
    function getOpenIssues();
    
    function setOpenIssues($issues);
    
    function hasFork();
    
    function setFork($fork);
    
    function getForks();
    
    function setForks($forks);
    
    function getWatchers();
    
    function setWatchers($watchers);
}