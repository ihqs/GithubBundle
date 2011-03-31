<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\GithubBundle\Manager;

use IHQS\GithubBundle\Model\CommitInterface;

abstract class CommitManager extends BaseManager implements CommitManagerInterface
{
    /***
     * Finders
     ***/
    public function findOneByGitId($gitId)
    {
        return $this->repository->findOneByGitId($gitId);
    }
    
    /***
     * Constructors
     ***/
    public function createCommit($data = null)
    {
        return $this->doCreateObject($data);
    }

    public function createCommitFromApi($username, $repo, $gitId)
    {
        $commit = $this->findOneByGitId($gitId);
        if(!is_null($commit))
        {
            return $commit;
        }

        $em = $this->container->get('ihqs_github.model_manager');
        $commit_data = $this->container->get('ihqs_github.api')->getCommitApi()->getCommit($username, $repo, $gitId);
        $commit = $this->createCommit($commit_data);
        $commit->setRepository($this->container->get('ihqs_github.manager.repository')->findOneByName($repo));
        $em->persist($commit);
        $em->flush();

        return $commit;
    }

    public function createCommitsByBranchFromApi($username, $repo, $gitId)
    {
        $repo       = $this->container->get('ihqs_github.manager.repository')->createRepositoryFromApi($username, $repo);
        $commits    = $this->container->get('ihqs_github.api')->getCommitApi()->getBranchCommits($username, $repo->getName(), $gitId);

        $results = array();
        foreach($commits as $commit)
        {
            $results[] = $this->createCommitFromApi($username, $repo->getName(), $commit['id']);
        }
        return $results;
    }

    public function createCommitsByRepositoryFromApi($username, $repo)
    {
        $repo       = $this->container->get('ihqs_github.manager.repository')->createRepositoryFromApi($username, $repo);
        $branches   = $this->container->get('ihqs_github.api')->getRepoApi()->getRepoBranches($username, $repo->getName());

        $results = array();
        foreach($branches as $name => $id)
        {
            $results[] = $this->createCommitsByBranchFromApi($username, $repo->getName(), $id);
        }

        return $results;
    }

    public function createCommitsByUserFromApi($username)
    {
        $repositories = $this->container->get('ihqs_github.manager.repository')->createRepositoriesByOwnerFromApi($username);

        $results = array();
        foreach($repositories as $repository)
        {
            $results[] = $this->createCommitsByRepositoryFromApi($username, $repository->getName());
        }

        return $results;
    }

    public function createCommitsByOrganizationFromApi($name)
    {
        $users = $this->container->get('ihqs_github.manager.user')->createUserByOrganizationFromApi($name);

        $results = array();
        $results[] = $this->createCommitsByUserFromApi($name);
        foreach($users as $user)
        {
            $results[] = $this->createCommitsByUserFromApi($user->getLogin());
        }

        return $results;
    }
    
    /***
     * Factory
     ***/
    public function import(CommitInterface $commit, array $data = array())
    {
        return $this->doImport($commit, $data);
    }
    
    public function importId(CommitInterface $commit, $value)
    {
        $commit->setGitId($value);
    }
    
    public function importCommittedDate(CommitInterface $commit, $value)
    {
        $commit->setCommittedDate(new \DateTime($value));
    }
    
    public function importAuthoredDate(CommitInterface $commit, $value)
    {
        $commit->setAuthoredDate(new \DateTime($value));
    }
    
    public function importParents(CommitInterface $commit, array $value = array())
    {
        foreach($value as $parent_data)
        {
            if(!isset($parent_data['id'])) { break; }
            
            $parent = $this->findOneByGitId($parent_data['id']);
            if(!is_null($parent))
            {
                $commit->addParent($parent);
            }
        }
    }
    
    public function importAuthor(CommitInterface $commit, array $value = array())
    {
        if(!isset($value['login'])) { break; }
            
        $author = $this->container->get('ihqs_github.manager.user')->findOneByLogin($value['login']);
        if(!is_null($author))
        {
            $commit->setAuthor($author);
        }
    }
    
    public function importCommitter(CommitInterface $commit, array $value = array())
    {
        if(!isset($value['login'])) { break; }
        
        $committer = $this->container->get('ihqs_github.manager.user')->findOneByLogin($value['login']);
        if(!is_null($committer))
        {
            $commit->setCommitter($committer);
        }
    }
}