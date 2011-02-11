<?php

/**
 * (c) Antoine Berranger <antoine@ihqs.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\IHQS\GithubBundle\Command;

use Symfony\Component\Security\Authentication\Token\UsernamePasswordToken;
use Symfony\Bundle\FrameworkBundle\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;

class RefreshCommitsCommand extends BaseCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('ihqs:github:refresh')
            ->setDescription('Refresh commits given user account informations')
            ->setDefinition(array())
            ->setHelp(<<<EOT
The <info>ihqs:github:refresh</info> command gets every github commits of the user's public projets

  <info>php app/consolehqs:github:refresh</info>
EOT
            );
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Refreshing commits');

        $manager = $this->container->get('ihqs_github.account_manager');
        $manager->updateAccount($this->container->getParameter('ihqs_github.github.login'));

        $output->writeln('Done');
    }
}