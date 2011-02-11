Provides persistency for your Github API requests

Features
========

- Compatible with Doctrine ORM **and** ODM thanks to a generic repository.
- Model is extensible at will

Installation
============

Add GithubBundle to your src/ dir
-------------------------------------

::

    $ git submodule add git://github.com/ihqs/GithubBundle.git    src/IHQS/GithubBundle
    $ git submodule add git://github.com/ihqs/php-github-api.git  src/vendor/php-github-api

Add the php-github-api class to your project's autoload boostrap
----------------------------------------------------------------

::
    // src/autoload.php
    $loader->registerPrefixes(array(
        'phpGitHubApi' => $vendorDir.'/php-github-api/lib',
    ));


Add the IHQS namespace to your autoloader
----------------------------------------

::
    // app/autoload.php
    $loader->registerNamespaces(array(
        'IHQS' => __DIR__,
        // your other namespaces
    );

Add UserBundle to your application kernel
-----------------------------------------

::

    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            // ...
            new IHQS\GithubBundle\IHQSGithubBundle(),
            // ...
        );
    }
    
Update your schema
------------------

::
    app/console doctrine:schema:update --force