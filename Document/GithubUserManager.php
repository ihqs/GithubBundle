<?php

namespace IHQS\GithubBundle\Document;

use Doctrine\ORM\DocumentManager;
use Bundle\IHQS\GithubBundle\Manager\UserManager as BaseUserManager;

class GithubUserManager extends BaseUserManager
{
    protected $dm;
    protected $class;
    protected $repository;

    public function __construct(DocumentManager $dm, $class)
    {
        $this->dm = $dm;
        $this->repository = $dm->getRepository($class);

        $metadata = $dm->getClassMetadata($class);
        $this->class = $metadata->name;
    }
}