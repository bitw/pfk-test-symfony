<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Distributor;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDistributorData implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$distributor = new Distributor();
		$distributor->setName('Дистрибутор 1');
		$manager->persist($distributor);

		$distributor = new Distributor();
		$distributor->setName('Дистрибутор 2');
		$manager->persist($distributor);

		$manager->flush();
	}
}