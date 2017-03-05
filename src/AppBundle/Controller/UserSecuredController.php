<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/secure")
 * @Security("has_role('ROLE_USER')")
 */
class UserSecuredController extends Controller
{
    /**
     * @Route("")
     */
    public function indexAction(Request $request)
    {
        return $this->render('user/index.html.twig');
    }
}
