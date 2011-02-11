<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\IHQS\GithubBundle\Manager;

use Bundle\IHQS\GithubBundle\Model\RepositoryInterface;

interface RepositoryManagerInterface
{
    function findOneByName($name);
    
    function createRepository($data = null);
    
    function import(RepositoryInterface $repository, array $data = array());
    
    function importId(RepositoryInterface $repository, $value);
    
    function importCreatedAt(RepositoryInterface $repository, $value);
    
    function importPushedAt(RepositoryInterface $repository, $value);
    
    function importOwner(RepositoryInterface $repository, $value);
    
    function getClass();
}