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
        $chore = new Chore();
        $chore->setChore('Write a blog post');
        $chore->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createForm(ChoreType::class, $chore);

        return $this->render('Chore/default.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
