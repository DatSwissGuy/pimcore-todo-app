<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ContentController extends FrontendController
{
    /**
     * @Template()
     */
    public function defaultAction(Request $request)
    {

    }
}
