<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ChoreType;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Chore;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ChoreController extends FrontendController
{
    /**
     * @Template()
     */
    public function defaultAction(Request $request)
    {
        $choreListing = new Chore\Listing();
        $chores = $choreListing->getObjects();

        $form = $this->createForm(ChoreType::class)->createView();

        $params = [
            'chores' => $chores,
            'form' => $form
        ];

        return $this->render('Chore/default.html.twig',$params);
    }

    public function addChoreAction(Request $request)
    {
    }
}
