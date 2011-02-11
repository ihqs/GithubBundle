<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\IHQS\GithubBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\FileLocator;

class GithubExtension extends Extension
{
    public function configLoad(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config')));
        $loader->load('github.xml');
        
        foreach($config as $config_unit)
        {
            $this->doConfigLoad($config_unit, $container);
        }
    }
    
    public function doConfigLoad(array $config, ContainerBuilder $container)
    {
        if(!function_exists('curl_init'))
        {
            throw new \RuntimeException('GithubBundle needs lib curl to be installed on your server');
        }

        $class = $container->getParameter('ihqs_github.api.class');
        if(!class_exists('\\' . $class))
        {
            throw new \RuntimeException("Impossible to load your api class");
        } 
        
        // loading base bundle config
        if(!isset($config['db_driver'])
        || !in_array(strtolower($config['db_driver']), array('orm', 'mongodb')))
        {
            throw new \InvalidArgumentException(sprintf('Invalid db driver "%s".', $config['db_driver']));
        }

        $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config')));
        $loader->load(sprintf('%s.xml', $config['db_driver']));
        
        // loading github api variables
        if(isset($config['github']['login']))
        {
            $container->setParameter('ihqs_github.github.login', $config['github']['login']);
            
            if(isset($config['github']['secret']))
            {
                $container->setParameter('ihqs_github.github.secret', $config['github']['secret']);
            }
        }

        // loading proper account manager
        $type = isset($config['github']['type']) ?
            $config['github']['type'] :
            $container->getParameter('ihqs_github.github.type');

        if(!$container->has('ihqs_github.manager.' . $type))
        {
            throw new \RuntimeException("Impossible to find an account manager for account type " . $type);
        }
        
        $container->setAlias('ihqs_github.account_manager', 'ihqs_github.manager.' . $type);
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension\ExtensionInterface
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension\ExtensionInterface
     */
    public function getNamespace()
    {
        return 'http://www.symfony-project.org/shemas/dic/symfony';
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension\ExtensionInterface
     */
    public function getAlias()
    {
        return 'ihqs_github';
    }
}