<?php

namespace AppBundle\Controller;

use AppBundle\Forms\ImportType;
use AppBundle\Models\Import;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/import")
 */
class ImportController extends Controller
{
	/**
	 * @Route("", name="import.index")
	 * @Method({"GET","HEAD", "POST"})
	 */
	public function indexAction(Request $request)
	{
		$form = $this->createForm(ImportType::class, new Import());

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$import = $this->get('app.import');

			if ($form->getData()->getReplace()) {
				$import->dropItems($form);
			}

			$items = $import->importItems($form->getData());

			$this->addFlash('count', count($items));

			return $this->redirectToRoute('import.index');
		}

		return $this->render(
			'AppBundle:Import:import.html.twig',
			[
				'form' => $form->createView(),
			]
		);
	}
}