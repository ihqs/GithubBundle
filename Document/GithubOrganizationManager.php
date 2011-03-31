<?php

namespace IHQS\GithubBundle\Document;

use Doctrine\ORM\DocumentManager;
use Bundle\IHQS\GithubBundle\Manager\OrganizationManager as BaseOrganizationManager;

class GithubOrganizationManager extends BaseOrganizationManager
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