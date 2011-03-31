<?php

namespace IHQS\GithubBundle\Document;

use Doctrine\ORM\DocumentManager;
use IHQS\GithubBundle\Manager\RepositoryManager as BaseRepositoryManager;

class GithubRepositoryManager extends BaseRepositoryManager
{
    protected $dm;
    protected $class;
    protected $repository;
    protected $userManager;

    public function __construct(DocumentManager $dm, $class, UserManagerInterface $userManager)
    {
        $this->dm = $dm;
        $this->userManager = $userManager;
        $this->repository = $dm->getRepository($class);

        $metadata = $dm->getClassMetadata($class);
        $this->class = $metadata->name;
    }
}