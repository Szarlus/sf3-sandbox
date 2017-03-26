<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/example")
 */
class ExampleController extends Controller
{
    /**
     * @Route("/dump", name="example_dump")
     */
    public function exampleDumpAction()
    {
        dump('example string');
        dump(['key1' => 'val1', 'key2' => 'val2', 'key3' => 2.3, 'key4' => new Category('category')]);

        dump(new Category('example'));

        return $this->render('example/example_dump.html.twig');
    }

    /**
     * @Route("/services", name="example_services")
     */
    public function exampleServicesAction()
    {
        $serviceA1 = $this->get('app.service_a');
        $serviceA2 = $this->get('app.service_a');

        echo '1) $serviceA1 === $serviceA2</br>';
        var_dump($serviceA1 === $serviceA2);

        $serviceAFromFactory1 = $this->get('app.service_a_from_factory');
        $serviceAFromFactory2 = $this->get('app.service_a_from_factory');

        echo '2) $serviceAFromFactory1 === $serviceAFromFactory2</br>';
        var_dump($serviceAFromFactory1 === $serviceAFromFactory2);

        echo '3) $serviceA1 === $serviceAFromFactory1</br>';
        var_dump($serviceA1 === $serviceAFromFactory1);

        echo '4) checking what service B implements</br>';
        $serviceWithLazyDep = $this->get('app.service_with_lazy_dep');
        $serviceWithLazyDep->showWhatServiceBImplements();

        echo '5) $serviceWithLazyDep->callB()</br>';
        var_dump($serviceWithLazyDep->callB());

        die;
    }
}
