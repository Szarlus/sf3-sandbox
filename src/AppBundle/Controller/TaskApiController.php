<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\Type\TaskType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/task")
 */
class TaskApiController extends FOSRestController
{
    /**
     * @Route("", name="task_api_list")
     * @Method("GET")
     * @Rest\View
     */
    public function listAction()
    {
        return $this->getDoctrine()->getManager()->getRepository(Task::class)->findAll();
    }

    /**
     * @Route("/{id}", name="task_api_get")
     * @Method("GET")
     * @Rest\View(serializerGroups={"task_details"})
     */
    public function getAction($id)
    {
        $task = $this->getDoctrine()->getManager()->getRepository(Task::class)->find($id);

        if (!$task) {
            $this->createNotFoundException("Task of id $id was not found");
        }

        return $task;
    }

    /**
     * @Route("", name="task_api_create")
     * @Method("POST")
     * @Rest\View
     */
    public function createAction(Request $request)
    {
        $task = new Task();
        $form = $this->createTaskForm($task, $request->getMethod());

        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $form;
        }

        $task = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return $this->view(['id' => $task->id()], 201);
    }

    /**
     * @Route("/{id}", name="task_api_edit")
     * @Method("PUT")
     * @Rest\View
     */
    public function editAction(Request $request, $id)
    {
        $task = $this->getDoctrine()->getManager()->getRepository(Task::class)->find($id);

        if (!$task) {
            throw $this->createNotFoundException("Task of id $id was not found");
        }

        $form = $this->createTaskForm($task, $request->getMethod());

        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $form;
        }

        $this->getDoctrine()->getManager()->flush();
    }

    /**
     * @Route("/{id}", name="task_api_delete")
     * @Method("DELETE")
     * @Rest\View
     */
    public function deleteAction($id)
    {
        $task = $this->getDoctrine()->getManager()->getRepository(Task::class)->find($id);

        if (!$task) {
            throw $this->createNotFoundException("Task of id $id was not found");
        }

        $this->getDoctrine()->getManager()->remove($task);
        $this->getDoctrine()->getManager()->flush();
    }

    /**
     * @param Task $task
     * @param $method
     * @return FormInterface
     */
    private function createTaskForm(Task $task, $method)
    {
        return $this
            ->get('form.factory')
            ->createNamed(null, TaskType::class, $task, [
                'method' => $method,
                'csrf_protection' => false
            ]);
    }
}
