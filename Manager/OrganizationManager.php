<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\GithubBundle\Manager;

use Bundle\IHQS\GithubBundle\Model\OrganizationInterface;

abstract class OrganizationManager extends BaseManager implements OrganizationManagerInterface
{
    /***
     * Finders
     ***/
    public function findOneByName($name)
    {
        $user = $this->container->get('ihqs_github.manager.user')->findOneByLogin($name);
        if(is_null($user)) { return null; }
        return $this->repository->findOneByUser($user->getId());
    }
    
    /***
     * Factory
     ***/
    public function createOrganization($data = null)
    {
        return $this->doCreateObject($data);
    }

    public function createOrganizationFromApi($name)
    {
        $orga = $this->findOneByName($name);
        if(!is_null($orga))
        {
            return $orga;
        }

        $em = $this->container->get('ihqs_github.model_manager');
        $orga_data = $this->container->get('ihqs_github.api')->getOrganizationApi()->show($name);
        $orga = $this->createOrganization($orga_data);
        $em->persist($orga);
        $em->flush();

        return $orga;
    }

    public function updateAccount($name)
    {
        return $this->container->get('ihqs_github.manager.commit')->createCommitsByOrganizationFromApi($name);
    }
    
    /***
     * Importers
     ***/
    public function import(OrganizationInterface $organization, array $data = array())
    {
        $user = $this->container->get('ihqs_github.manager.user')->createUser($data);
        $organization->setUser($user);
    }
    
    public function importId(OrganizationInterface $organization, $value)
    {
        $organization->setGitId($value);
    }
    
    public function importTeams(OrganizationInterface $organization, array $value = array())
    {
        foreach($value as $team)
        {
            // TODO
        }
    }
    
    public function importUsers(OrganizationInterface $organization, array $value = array())
    {
        foreach($value as $user_data)
        {
            $user = $this->container->get('ihqs_github.manager.user')->findByLogin($user_data['login']);
            if(is_null($user))
            {
                $user = $this->container->get('ihqs_github.manager.user')->createUser($user_data);
            }
            
            $organization->addPublicMember($user); 
        }
    }
}