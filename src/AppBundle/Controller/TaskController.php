<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\Type\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/task")
 */
class TaskController extends Controller
{

    /**
     * @Route("/list", name="tasks_list")
     */
    public function listAction(Request $request)
    {
        return $this->render('task/list.html.twig');
    }

    /**
     * @Route("/view/{id}", name="task_view")
     */
    public function viewAction($id)
    {
        $task = $this->getDoctrine()->getManager()->getRepository(Task::class)->find($id);

        return $this->render('task/view.html.twig', ['task' => $task]);
    }

    /**
     * @Route("/new", name="task_new")
     * @Method({"POST", "GET"})
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(TaskType::class, new Task());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('task_view', ['id' => $task->id()]);
        }

        return $this->render('task/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/update/{id}")
     * @Method("PUT")
     */
    public function updateAction($id)
    {
        return $this->render('task/list.html.twig');
    }

    /**
     * @Route("/delete/{id}")
     */
    public function deleteAction($id)
    {
        return $this->redirect($this->generateUrl('tasks_list'));
    }
}
