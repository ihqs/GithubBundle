<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace IHQS\GithubBundle\Model;

interface CommitInterface
{
    function getId();
    
    function getGitId();
    
    function setGitId($gitId);
    
    function getUrl();
    
    function setUrl($url);
    
    function getCommittedDate();
    
    function setCommittedDate(\DateTime $date);
    
    function getAuthoredDate();
    
    function setAuthoredDate(\DateTime $date);
    
    function getMessage();
    
    function setMessage($message);
    
    function getTree();
    
    function setTree($tree);
    
    function getParents();
    
    function addParent(CommitInterface $parent);
    
    function getChildren();

    function addChild(CommitInterface $children);
    
    function getAuthor();
    
    function setAuthor(UserInterface $author);
    
    function getCommitter();
    
    function setCommitter(UserInterface $committer);

    function getRepository();

    function setRepository(RepositoryInterface $repository);
}