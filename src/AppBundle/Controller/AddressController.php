<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("address")
 */
class AddressController extends Controller
{
    /**
     * @Route("", name="address.index")
     * @Method({"GET", "HEAD"})
     */
    public function indexAction()
    {
        $repositoryItem = $this->getDoctrine()->getRepository('AppBundle:Item');

        $qb = $repositoryItem->createQueryBuilder('item');
        $query = $qb->select('item.address')
            ->groupBy('item.address')
            ->getQuery();

        return $this->render('AppBundle:Address:index.html.twig', [
            'adresses' => $query->getResult(),
        ]);
    }

    /**
     * @Route("", name="address.update")
     * @Method("POST")
     */
    public function updateAction(Request $request)
    {
        $this->addFlash('notices', [
            'type' => 'success',
            'text' => 'Адрес изменен.'
        ]);

        $this->getDoctrine()->getRepository('AppBundle:Item')->updateByField(
        	'address',
            $request->get('old_value'),
            $request->get('new_value')
        );

        return $this->redirectToRoute('address.index');
    }

}
