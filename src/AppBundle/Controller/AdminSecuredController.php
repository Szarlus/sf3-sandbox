<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/admin/secure")
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminSecuredController extends Controller
{
    /**
     * @Route("")
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');
    }
}
