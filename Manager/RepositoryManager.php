<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\GithubBundle\Manager;

use Bundle\IHQS\GithubBundle\Model\RepositoryInterface;

abstract class RepositoryManager extends BaseManager implements RepositoryManagerInterface
{
    /***
     * Finders
     ***/
    public function findOneByName($name)
    {
        return $this->repository->findOneByName($name);
    }
    
    /***
     * Factory
     ***/
    public function createRepository($data = null)
    {
        return $this->doCreateObject($data);
    }

    public function createRepositoryFromApi($username, $name)
    {
        $repo = $this->findOneByName($name);
        if(!is_null($repo))
        {
            return $repo;
        }

        $em = $this->container->get('ihqs_github.model_manager');
        $repo_data = $this->container->get('ihqs_github.api')->getRepoApi()->show($username, $name);

        $repo = $this->createRepository($repo_data);
        $em->persist($repo);
        $em->flush();

        return $repo;
    }
    
    public function createRepositoriesByOwnerFromApi($username)
    {
        $em = $this->container->get('ihqs_github.model_manager');
        
        $user           = $this->container->get('ihqs_github.manager.user')->createUserFromApi($username);
        $repositories   = $this->container->get('ihqs_github.api')->getRepoApi()->getUserRepos($username);

        $results = array();
        foreach($repositories as $repository)
        {
            $results[] = $this->createRepositoryFromApi($username, $repository['name']);
        }

        return $results;
    }
    
    /***
     * Importers
     ***/
    public function import(RepositoryInterface $repository, array $data = array())
    {
        return $this->doImport($repository, $data);
    }
    
    public function importId(RepositoryInterface $repository, $value)
    {
        $repository->setGitId($value);
    }
    
    public function importCreatedAt(RepositoryInterface $repository, $value)
    {
        $repository->setCreatedAt(new \DateTime($value));
    }
    
    public function importPushedAt(RepositoryInterface $repository, $value)
    {
        $repository->setPushedAt(new \DateTime($value));
    }
    
    public function importOwner(RepositoryInterface $repository, $value)
    {
        $owner = $this->container->get('ihqs_github.manager.user')->findOneByLogin($value);
        if(!is_null($owner))
        {
            $repository->setOwner($owner);
        }
    }
}