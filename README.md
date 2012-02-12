This bundle provides persistency for your Github API requests

# Todo

 * Update readme file
 * Add mongodb configuration files
 * Add unit tests
 * Comment methods and attributes
 
# Features

- Compatible with Doctrine ORM **and** ODM thanks to a generic repository.
- Authentication
- Command lines to retrieve github data, useful to work with crontabs

# Installation

## Add GithubBundle to your src/ dir

<pre>
    $ git submodule add git://github.com/ihqs/GithubBundle.git    src/IHQS/GithubBundle
    $ git submodule add git://github.com/ihqs/php-github-api.git  src/vendor/php-github-api
</pre>

## Add the php-github-api class to your project's autoload boostrap

<pre>
    // src/autoload.php
    $loader->registerPrefixes(array(
        'phpGitHubApi' => $vendorDir.'/php-github-api/lib',
    ));
</pre>

## Add the IHQS namespace to your autoloader

<pre>
    // app/autoload.php
    $loader->registerNamespaces(array(
        'IHQS' => __DIR__,
        // your other namespaces
    );
</pre>

## Add UserBundle to your application kernel

<pre>
    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            // ...
            new IHQS\GithubBundle\IHQSGithubBundle(),
            // ...
        );
    }
</pre>

# Configuration

## Config file config.yml

<pre>
ihqs_github:
	db_driver: [orm|mongodb]
	github:
		login: [your login]
		secret: [your password]
		type: [user|organization] (by default: user)
</pre>

## Update your schema

<pre>
    app/console doctrine:schema:update --force
</pre>

## Retreiving data

If the path to your sf2 console is "app/console", then you'll just have to type

<pre>
	app/console ihqs:github:retrieve
</pre>