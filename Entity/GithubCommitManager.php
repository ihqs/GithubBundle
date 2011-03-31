<?php

namespace IHQS\GitHubBundle\Entity;

use Doctrine\ORM\EntityManager;
use Bundle\IHQS\GithubBundle\Manager\CommitManager as BaseCommitManager;

class GithubCommitManager extends BaseCommitManager
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