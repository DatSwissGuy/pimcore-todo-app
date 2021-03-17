<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ChoreType;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Chore;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChoreController extends FrontendController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function defaultAction(Request $request): Response
    {
        $newChore = new Chore();
        $choreListing = new Chore\Listing();
        $chores = $choreListing->getObjects();

        $form = $this->createForm(ChoreType::class);
        $form->handleRequest($request);

        // TODO check if entity already exists and warn user
        if ($form->isSubmitted() && $form->isValid()) {

            $newChore->setTitle($form['title']->getData());
            $newChore->setDueDate($form['dueDate']->getData());
            $newChore->setKey($form['title']->getData());
            $newChore->setParentId(2);
            $newChore->setPublished(true);
            $newChore->save();

            return new redirectResponse('/chores');
        }

        $params = [
            'chores' => $chores,
            'form' => $form->createView()
        ];

        return $this->renderTemplate('Chore/default.html.twig', $params);
    }
}
