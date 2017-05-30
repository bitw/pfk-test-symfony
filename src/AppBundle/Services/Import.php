<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 25.05.17
 * Time: 8:00
 */

namespace AppBundle\Services;

use AppBundle\Entity\Item;
use Doctrine\ORM\EntityManager;

class Import
{

	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	/**
	 * @param $data
	 * @return int
	 */
	public function importItems($data)
	{
		$content = trim(file_get_contents($data->getFile()->getPathname()));
		$rows = explode("\r\n", $content);
		unset($rows[0]);

		$rule = mb_substr($content, 1, 6) == 'Аптека'
			? ['address', 'product', 'amount']
			: ['product', 'address', 'amount'];

		$items = [];
		$this->em->transactional(function ($em) use ($rows, $rule, $data, &$items) {
			foreach ($rows as $row) {
				if (!strlen(trim($row))) continue;
				$row = explode("\t", $row);

				$item = [
					$rule[0] => $row[0],
					$rule[1] => $row[1],
					$rule[2] => $row[2],
				];
				$oItem = new Item();
				$oItem->setDistributor($data->getDistributor());
				$oItem->setAddress($item['address']);
				$oItem->setProduct($item['product']);
				$oItem->setAmount($item['amount']);

				$em->persist($oItem);

				$items[] = $oItem;
			}
		});

		return $items;
	}


	public function dropItems($distributor_id = null)
	{
		$queryBuilder = $this->em->createQueryBuilder();

		if ($distributor_id !== null) {
			$queryBuilder->where('distributor_id = :distributor')
				->setParameter('distributor', $distributor_id);
		}

		$queryBuilder->delete('Item', 'i');
	}
}