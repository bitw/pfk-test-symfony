<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("product")
 *
 * Class ItemController
 * @package AppBundle\Controller
 */
class ProductController extends Controller
{
    /**
     * @Route("", name="product.index")
     * @Method({"GET", "HEAD"})
     */
    public function indexAction()
    {
	    $repositoryItem = $this->getDoctrine()->getRepository('AppBundle:Item');

	    $qb = $repositoryItem->createQueryBuilder('item');
	    $query = $qb->select('item.product as name, sum(item.amount) as amount')
		    ->groupBy('item.product')
		    ->getQuery();

        return $this->render('AppBundle:Product:index.html.twig', array(
            'products' => $query->getResult()
        ));
    }

    /**
     * @Route("", name="product.update")
     * @Method("POST")
     */
    public function updateAction(Request $request)
    {
	    $this->addFlash('notices', [
		    'type' => 'success',
		    'text' => 'Наименование препарата изменено.'
	    ]);

	    $this->getDoctrine()->getRepository('AppBundle:Item')->updateByField(
		    'product',
		    $request->get('old_value'),
		    $request->get('new_value')
	    );

	    return $this->redirectToRoute('product.index');
    }

}
