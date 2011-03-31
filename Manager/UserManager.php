<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\GithubBundle\Manager;

use IHQS\GithubBundle\Model\UserInterface;

abstract class UserManager extends BaseManager implements UserManagerInterface
{
    /***
     * Finders
     ***/
    public function findOneByGitId($gitId)
    {
        return $this->repository->findOneByGitId($gitId);
    }
    
    public function findOneByLogin($login)
    {
        return $this->repository->findOneByLogin($login);
    }
    
    /***
     * Factory
     ***/
    public function createUser($data = null)
    {
        return $this->doCreateObject($data);
    }
    
    public function createUserFromApi($name)
    {
        $user = $this->findOneByLogin($name);
        if(!is_null($user))
        {
            return $user;
        }
        
        $em = $this->container->get('ihqs_github.model_manager');
        $user_data = $this->container->get('ihqs_github.api')->getUserApi()->show($name);
        
        $user = $this->createUser($user_data);
        $em->persist($user);
        $em->flush();
        
        return $user;
    }

    public function createUserByOrganizationFromApi($name)
    {
        $organization = $this->container->get('ihqs_github.manager.organization')->createOrganizationFromApi($name);

        $users = $this->container->get('ihqs_github.api')->getOrganizationApi()->getPublicMembers($name);
 
        $results = array();
        $result[] = $organization->getUser();
        
        foreach($users as $user)
        {
            $member = $this->createUserFromApi($user['login']);
            $organization->addPublicMember($member);
            $results[] = $member;
        }

        $em = $this->container->get('ihqs_github.model_manager');
        $em->persist($organization);
        $em->flush();

        return $results;
    }

    public function updateAccount($name)
    {
        return $this->container->get('ihqs_github.manager.commit')->createCommitsByUserFromApi($name);
    }
    
    /***
     * Importers
     ***/
    public function import(UserInterface $user, array $data = array())
    {
        return $this->doImport($user, $data);
    }
    
    public function importId(UserInterface $user, $value)
    {
        $user->setGitId($value);
    }
    
    public function importCreatedAt(UserInterface $user, $value)
    {
        $user->setCreatedAt(new \DateTime($value));
    }
    
    public function importOwnedPrivateRepoCount(UserInterface $user, $value)
    {
        $user->setTotalOwnedPrivateRepositories($value);
    }
    
    public function importTotalPrivateRepoCount(UserInterface $user, $value)
    {
        $user->setTotalPrivateRepositories($value);
    }
}