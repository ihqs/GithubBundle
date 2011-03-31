<?php

namespace IHQS\GithubBundle\Entity;

use Doctrine\ORM\EntityManager;
use Bundle\IHQS\GithubBundle\Manager\OrganizationManager as BaseOrganizationManager;

class GithubOrganizationManager extends BaseOrganizationManager
{
    protected $em;
    protected $class;
    protected $repository;

    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repository  = $em->getRepository($class);

        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
    }
}