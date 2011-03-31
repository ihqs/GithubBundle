<?php

namespace IHQS\GithubBundle\Entity;

use IHQS\GithubBundle\Model\UserLogged as BaseUser;
use IHQS\GithubBundle\Model\UserInterface;

class GithubUser extends BaseUser implements UserInterface
{
    protected $id;
    
    public function getId()
    {
        return $this->id;
    }
}