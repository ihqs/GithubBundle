<?php

namespace Bundle\IHQS\GithubBundle\Entity;

use Doctrine\ORM\EntityManager;
use Bundle\IHQS\GithubBundle\Manager\UserManager as BaseUserManager;

class GithubUserManager extends BaseUserManager
{
    protected $em;
    protected $class;
    protected $repository;

    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);

        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
    }
}