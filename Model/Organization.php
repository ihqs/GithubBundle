<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\GithubBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

abstract class Organization implements OrganizationInterface
{
    protected $id;
    protected $publicMembers;
    protected $teams;
    protected $user;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
        return $this;
    }
    
    public function getPublicMembers()
    {
        return $this->publicMembers ?: $this->publicMembers = new ArrayCollection();
    }

    public function hasPublicMember(UserInterface $member)
    {
        return $this->getPublicMembers()->contains($member);
    }

    public function addPublicMember(UserInterface $member)
    {
        if (!$this->hasPublicMember($member)) 
        {
            $this->getPublicMembers()->add($member);
        }
        return $this;
    }
    
    public function removePublicMember(UserInterface $member)
    {
        if ($this->hasPublicMember($member)) 
        {
            $this->getPublicMembers()->remove($member);
        }
        return $this;
    }
    
    public function getTeams()
    {
        return $this->teams ?: $this->teams = new ArrayCollection();
    }
    
    public function hasTeam(OrganizationInterface $team)
    {
        return $this->getTeams()->contains($team);
    }
    
    public function addTeam(OrganizationInterface $team)
    {
        if (!$this->hasTeam($team)) 
        {
            $this->getTeams()->add($team);
        }
        return $this;
    }
    
    public function removeTeam(OrganizationInterface $team)
    {
        if ($this->hasTeam($team)) 
        {
            $this->getTeams()->remove($team);
        }
        return $this;
    }
}