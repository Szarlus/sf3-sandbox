<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\Type\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $tasks = $this->getDoctrine()->getManager()->getRepository(Task::class)->findAll();

        return $this->render('task/list.html.twig', ['tasks' => $tasks]);
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

            $this->addFlash('success', 'Task was added');

            return $this->redirectToRoute('task_view', ['id' => $task->id()]);
        }

        return $this->render('task/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="task_edit")
     * @Method({"PUT", "GET"})
     */
    public function editAction(Request $request, $id)
    {
        $task = $this->getDoctrine()->getManager()->getRepository(Task::class)->find($id);

        $form = $this->createForm(TaskType::class, $task, ['method'=> 'PUT']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Task was updated');

            return $this->redirectToRoute('task_edit', ['id' => $task->id()]);
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
            'task' => $task
        ]);
    }

    /**
     * @Route("/delete/{id}", name="task_delete")
     */
    public function deleteAction($id)
    {
        $task = $this->getDoctrine()->getManager()->getRepository(Task::class)->find($id);

        $this->getDoctrine()->getManager()->remove($task);
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', 'Task was deleted');

        return $this->redirect($this->generateUrl('tasks_list'));
    }
}
