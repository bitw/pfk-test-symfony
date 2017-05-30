<?php

namespace AppBundle\Command;

use AppBundle\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ResetCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('reset')
            ->setDescription('Reset items');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
	    $qb = $this
		    ->getContainer()
		    ->get('doctrine')
		    ->getRepository('AppBundle:Item')
		    ->createQueryBuilder('item');

	    $query = $qb->delete('AppBundle:Item', 'item')->getQuery();

	    $query->execute();

        $output->writeln('Table `items` cleared.');
    }

}
