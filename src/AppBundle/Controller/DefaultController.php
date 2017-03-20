<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/example-dump", name="example_dump")
     */
    public function exampleDumpAction()
    {
        dump('example string');
        dump(['key1' => 'val1', 'key2' => 'val2', 'key3' => 2.3, 'key4' => new Category('category')]);

        dump(new Category('example'));

        return $this->render('default/example_dump.html.twig');
    }
}
