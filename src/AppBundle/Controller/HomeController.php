<?php

namespace AppBundle\Controller;

use Doctrine\ORM\Query\Expr\Join;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
	/**
	 * @Route("/", name="homepage")
	 * @Method({"GET", "HEAD"})
	 */
	public function indexAction(Request $request)
	{
		$qb = $this->getDoctrine()->getRepository('AppBundle:Item')->createQueryBuilder('item');

		$qb_addr = clone $qb;
		$query_addr = $qb_addr
			->select('item.address')
			->addGroupBy('item.address');

		$qb_items = clone $qb;
		$query_items = $qb_items->select(['item.address', 'item.product', 'IDENTITY(item.distributor) as distributor_id', 'distributor.name as distributor_name', 'sum(item.amount) as amount'])
			->leftJoin('AppBundle\Entity\Distributor', 'distributor', Join::WITH, 'item.distributor = distributor.id')
			->groupBy('item.address', 'item.product', 'item.distributor');

		if($request->query->has('address') && trim($request->query->get('address'))){
			$query_items->where('item.address = ' . $qb->expr()->literal($request->query->get('address')));
		}

		$items = $query_items->getQuery()->getResult();

		$data = [];
		$total = [];
		foreach ($items as $item) {
			$data[$item['address']][$item['product']][] = [
				'name' => $item['distributor_name'],
				'amount' => $item['amount']
			];
            $total[$item['address']][$item['product']] = array_sum(array_column($data[$item['address']][$item['product']], 'amount'));
		}

		return $this->render('AppBundle::index.html.twig', [
			'items' => $data,
			'addresses' => $query_addr->getQuery()->getResult(),
            'total' => $total
		]);
	}
}
