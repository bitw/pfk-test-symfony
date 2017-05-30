<?php

namespace AppBundle\Repository;

/**
 * ItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ItemRepository extends \Doctrine\ORM\EntityRepository
{
	public function updateByField($field, $oldValue, $newValue)
	{
		$qb = $this->createQueryBuilder('item');

		$query = $qb->update('AppBundle:Item', 'item')
			->set("item.{$field}", $qb->expr()->literal($newValue))
			->where("item.{$field} = :{$field}")
			->setParameter(":{$field}", $oldValue)
			->getQuery();

		return $query->execute();
	}
}
