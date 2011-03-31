<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\GithubBundle\Model;

abstract class UserLogged extends UserUnlogged implements UserLoggedInterface
{
    protected $totalPrivateRepositories;
    protected $totalOwnedPrivateRepositories;
    protected $collaborators;
    protected $diskUsage;
    protected $plan;
    
    public function getTotalPrivateRepositories()
    {
        return $this->totalPrivateRepositories;
    }
    
    public function setTotalPrivateRepositories($totalRepos)
    {
        $this->totalPrivateRepositories = $totalRepos;
        return $this;
    }
    
    public function getTotalOwnedPrivateRepositories()
    {
        return $this->totalOwnedPrivateRepositories;
    }
    
    public function setTotalOwnedPrivateRepositories($totalRepos)
    {
        $this->totalOwnedPrivateRepositories = $totalRepos;
        return $this;
    }
    
    public function getCollaborators()
    {
        return $this->collaborators;
    }
    
    public function setCollaborators($collaborators)
    {
        $this->collaborators = (int) $collaborators;
        return $this;
    }
    
    public function getDiskUsage()
    {
        return $this->diskUsage;
    }
    
    public function setDiskUsage($diskUsage)
    {
        $this->diskUsage = (int) $diskUsage;
        return $this;
    }
    
    public function getPlan()
    {
        return $this->plan;
    }
    
    public function setPlan(array $plan = array())
    {
        $this->plan = $plan['name'];
        return $this;
    }  
}