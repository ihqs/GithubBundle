<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\IHQS\GithubBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

abstract class Commit implements CommitInterface
{
    protected $id;
    protected $gitId;
    protected $url;
    protected $committedDate;
    protected $authoredDate;
    protected $message;
    protected $tree;
    protected $parents;
    protected $children;
    protected $author;
    protected $committer;
    protected $repository;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getGitId()
    {
        return $this->gitId;
    }
    
    public function setGitId($gitId)
    {
        $this->gitId = $gitId;
        return $this;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
    
    public function getCommittedDate()
    {
        return $this->committedDate;
    }
    
    public function setCommittedDate(\DateTime $date)
    {
        $this->committedDate = $date;
        return $this;
    }
    
    public function getAuthoredDate()
    {
        return $this->authoredDate;
    }
    
    public function setAuthoredDate(\DateTime $date)
    {
        $this->authoredDate = $date;
        return $this;
    }
    
    public function getMessage()
    {
        return $this->message;
    }
    
    public function setMessage($message)
    {
        $this->message = (string) $message;
        return $this;
    }
    
    public function getTree()
    {
        return $this->tree;
    }
    
    public function setTree($tree)
    {
        $this->tree = $tree;
        return $this;
    }
    
    public function getParents()
    {
        return $this->parents ?: $this->parents = new ArrayCollection();
    }
    
    public function hasParent(CommitInterface $parent)
    {
        return $this->getParents()->contains($parent);
    }

    public function addParent(CommitInterface $parent)
    {
        if (!$this->hasParent($parent)) 
        {
            $this->getParents()->add($parent);
        }
        return $this;
    }
    
    public function removeParent(CommitInterface $parent)
    {
        if ($this->hasParent($parent)) 
        {
            $this->getParents()->remove($parent);
        }
        return $this;
    }
    
    public function getChildren()
    {
        return $this->children ?: $this->children = new ArrayCollection();
    }
    
    public function hasChild(CommitInterface $children)
    {
        return $this->getChildren()->contains($children);
    }

    public function addChild(CommitInterface $children)
    {
        if (!$this->hasChildren($children)) 
        {
            $this->getChildren()->add($children);
        }
        return $this;
    }
    
    public function removeChild(CommitInterface $children)
    {
        if ($this->hasChildren($children)) 
        {
            $this->getChildren()->remove($children);
        }
        return $this;
    }
    
    public function getAuthor()
    {
        return $this->author;
    }
    
    public function setAuthor(UserInterface $author)
    {
        $this->author = $author;
        return $this;
    }
    
    public function getCommitter()
    {
        return $this->committer;
    }
    
    public function setCommitter(UserInterface $committer)
    {
        $this->committer = $committer;
        return $this;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function setRepository(RepositoryInterface $repository)
    {
        $this->repository = $repository;
        return $this;
    }
}