<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\GithubBundle\Model;

abstract class Repository implements RepositoryInterface
{
    protected $id;
    protected $type;
    protected $private;
    protected $owner;
    protected $language;
    protected $name;
    protected $description;
    protected $url;
    protected $homepage;
    protected $pushedAt;
    protected $createdAt;
    protected $score;
    protected $size;
    protected $hasDownloads;
    protected $hasWiki;
    protected $hasIssues;
    protected $openIssues;
    protected $fork;
    protected $forks;
    protected $watchers;

    public function getId()
    {
        return $this->id;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    public function isPrivate()
    {
        return (boolean) $this->private;
    }
    
    public function setPrivate($private)
    {
        $this->private = (boolean) $private;
        return $this;
    }
    
    public function getOwner()
    {
        return $this->owner;
    }
    
    public function setOwner(UserInterface $owner)
    {
        $this->owner = $owner;
        return $this;
    }
    
    public function getLanguage()
    {
        return $this->language;
    }
    
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
    
    public function getHomepage()
    {
        return $this->homepage;
    }
    
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
        return $this;
    }
    
    public function getPushedAt()
    {
        return $this->pushedAt;
    }
    
    public function setPushedAt(\DateTime $pushedAt)
    {
        $this->pushedAt = $pushedAt;
        return $this;
    }
    
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    
    public function getScore()
    {
        return $this->score;
    }
    
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }
    
    public function getSize()
    {
        return $this->size;
    }
    
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }
    
    public function hasDownloads()
    {
        return (boolean) $this->downloads;
    }
    
    public function setHasDownloads($downloads)
    {
        $this->hasDownloads = (boolean) $downloads;
        return $this;
    }
    
    public function hasWiki()
    {
        return (boolean) $this->hasWiki;
    }
    
    public function setHasWiki($wiki)
    {
        $this->hasWiki = (boolean) $wiki;
        return $this;
    }
    
    public function hasIssues()
    {
        return (boolean) $this->hasIssues;
    }
    
    public function setHasIssues($issues)
    {
        $this->hasIssues = (boolean) $issues;
        return $this;
    }
    
    public function getOpenIssues()
    {
        return $this->openIssues;
    }
    
    public function setOpenIssues($openIssues)
    {
        $this->openIssues = (int) $openIssues;
        return $this;
    }
    
    public function hasFork()
    {
        return (boolean) $this->fork;
    }
    
    public function setFork($fork)
    {
        $this->fork = (boolean) $fork;
        return $this;
    }
    
    public function getForks()
    {
        return $this->forks;
    }
    
    public function setForks($forks)
    {
        $this->forks = (int) $forks;
        return $this;
    }
    
    public function getWatchers()
    {
        return $this->watchers;
    }
    
    public function setWatchers($watchers)
    {
        $this->watchers = (int) $watchers;
        return $this;
    }
}