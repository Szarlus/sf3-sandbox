<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\Type\TaskType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/rest/task")
 */
class TaskRestController extends FOSRestController
{
    /**
     * @Route("", name="task_rest_list")
     * @Method("GET")
     * @Rest\View
     */
    public function listAction()
    {
        return $this->getDoctrine()->getManager()->getRepository(Task::class)->findAll();
    }

    /**
     * @Route("/{id}", name="task_rest_get")
     * @Method("GET")
     */
    public function getAction($id)
    {
        return $this->getDoctrine()->getManager()->getRepository(Task::class)->find($id);
    }

    /**
     * @Route("", name="task_rest_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(TaskType::class, new Task());

        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $form;
        }

        $task = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return $this->view($task->getId(), 201);
    }

    /**
     * @Route("/{id}", name="task_rest_edit")
     * @Method("PUT")
     */
    public function editAction(Request $request, $id)
    {
        $task = $this->getDoctrine()->getManager()->getRepository(Task::class)->find($id);

        $form = $this->createForm(TaskType::class, $task, ['method'=> 'PUT']);

        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $form;
        }

        $this->getDoctrine()->getManager()->flush();

        return $task;
    }

    /**
     * @Route("/{id}", name="task_rest_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {
        $task = $this->getDoctrine()->getManager()->getRepository(Task::class)->find($id);

        $this->getDoctrine()->getManager()->remove($task);
        $this->getDoctrine()->getManager()->flush();
    }
}
