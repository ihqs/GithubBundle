<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\IHQS\GithubBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class BaseManager implements ContainerAwareInterface
{
    protected $container;
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getRepository()
    {
        return $this->repository;
    }
    
    public function doCreateObject($data = null)
    {
        $class = $this->class;
        
        $object = new $class();
        
        if(is_array($data))
        {
            $this->import($object, $data);
        }
        
        return $object;
    }
    
    /***
     * Importers
     ***/
    public function doImport($object, array $data = array())
    {
        $methods = array();
        foreach($data as $key => $value)
        {
            if(strpos($key, "_") !== false)
            {
                $words = explode("_", $key);
                array_map("ucfirst", $words); 
                $key = implode("", $words); 
            }
            
            $importer = 'import' . ucfirst($key);
            $setter   = 'set' . ucfirst($key);
            
            if(method_exists($this, $importer))
            {
                $this->$importer($object, $value);
                continue;
            }
            
            if(method_exists($object, $setter))
            {
                $object->$setter($value);
                continue;
            }
        }    
    }

    public function getClass()
    {
        return $this->class;
    }
}