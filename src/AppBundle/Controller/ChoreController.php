<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Chore;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ChoreController extends FrontendController
{
    /**
     * @Template()
     */
    public function defaultAction(Request $request)
    {
        // creates a task object and initializes some data for this example
        $chore = new Chore();
        $chore->setChore('Write a blog post');
        $chore->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($chore)
            ->add('chore', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        return $this->render('Chore/default.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
