<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\GithubBundle\Model;

abstract class UserUnlogged implements UserUnloggedInterface
{
    protected $id;
    protected $gitId;
    protected $login;
    protected $email;
    protected $name;
    protected $type;
    protected $permission;
    protected $gravatarId;
    protected $company;
    protected $blog;
    protected $createdAt;
    protected $location;
    protected $publicRepoCount;
    protected $followingCount;
    protected $followersCount;
    
    protected $commits_author;
    protected $commits_committer;
    protected $repositories;
    protected $organizations;
    
    public function __construct($gitId = null)
    {
        $this->setGitId($gitId);
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getGitId()
    {
        return $this->gitId;
    }
    
    public function setGitId($gitId)
    {
        $this->gitId = $gitId;
        return $this;
    }
    
    public function getLogin()
    {
        return $this->login;
    }
    
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
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
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    public function getPermission()
    {
        return $this->permission;
    }
    
    public function setPermission($permission)
    {
        $this->permission = $permission;
        return $this;
    }
    
    public function getGravatarId()
    {
        return $this->gravatarId;
    }
    
    public function setGravatarId($gratavarId)
    {
        $this->gravatarId = $gratavarId;
        return $this;
    }
    
    public function getCompany()
    {
        return $this->company;
    }
    
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }
    
    public function getBlog()
    {
        return $this->blog;
    }
    
    public function setBlog($blog)
    {
        $this->blog = $blog;
        return $this;
    }
    
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    public function setCreatedAt(\DateTime $date)
    {
        $this->createdAt = $date;
        return $this;
    }
    
    public function getLocation()
    {
        return $this->location;
    }
    
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }
    
    public function getPublicRepoCount()
    {
        return $this->publicRepoCount;
    }
    
    public function setPublicRepoCount($count)
    {
        $this->publicRepoCount = $count;
        return $this;
    }
    
    public function getFollowingCount()
    {
        return $this->followingCount;
    }
    
    public function setFollowingCount($count)
    {
        $this->followingCount = $count;
        return $this;
    }
    
    function getFollowersCount()
    {
        return $this->followersCount;
    }
    
    function setFollowersCount($count)
    {
        $this->followersCount = $count;
        return $this;
    }
    
    public function getCommitsWhereAuthor()
    {
        return $this->commits_author ?: $this->commits_author = new ArrayCollection();
    }
    
    public function getCommitsWhereCommitter()
    {
        return $this->commits_committer ?: $this->commits_committer = new ArrayCollection();
    }
    
    public function getRepositories()
    {
        return $this->repositories ?: $this->repositories = new ArrayCollection();
    }
    
    public function hasRepository(RepositoryInterface $repository)
    { 
        return $this->getRepositories()->contains($repository);
    }
    
    public function addRepository(RepositoryInterface $repository)
    { 
        if(!$this->hasRepository($repository))
        {
            $this->getRepositories()->add($repository);
        }
        return $this;
    }
    
    public function removeRepository(RepositoryInterface $repository)
    {
        if($this->hasRepository($repository))
        {
            $this->getRepositories()->remove($repository);
        }
        return $this;
    }
    
    public function getOrganizations()
    {
        return $this->organizations ?: $this->organizations = new ArrayCollection();
    }
    
    public function hasOrganization(OrganizationInterface $organization)
    { 
        return $this->getOrganizations()->contains($organization);
    }
    
    public function addOrganization(OrganizationInterface $organization)
    { 
        if(!$this->hasOrganization($organization))
        {
            $this->getOrganizations()->add($organization);
        }
        return $this;
    }
    
    public function removeOrganization(OrganizationInterface $organization)
    {
        if(!$this->hasOrganization($organization))
        {
            $this->getOrganizations()->remove($organization);
        }
        return $this;
    }
    
}