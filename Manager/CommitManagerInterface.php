<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\IHQS\GithubBundle\Manager;

use Bundle\IHQS\GithubBundle\Model\CommitInterface;

interface CommitManagerInterface
{
    function findOneByGitId($gitId);
    
    function createCommit($data = null);
    
    function import(CommitInterface $commit, array $data = array());
    
    function importId(CommitInterface $commit, $value);
    
    function importCommittedDate(CommitInterface $commit, $value);
    
    function importAuthoredDate(CommitInterface $commit, $value);
    
    function importParents(CommitInterface $commit, array $value = array());
    
    function importAuthor(CommitInterface $commit, array $value = array());
    
    function importCommitter(CommitInterface $commit, array $value = array());

    function getClass();
}