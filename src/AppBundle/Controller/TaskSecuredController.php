<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/secure/task")
 * @Security("has_role('ROLE_USER')")
 */
class TaskSecuredController extends Controller
{
    /**
     * @Route("/{id}/begin", name="task_begin")
     */
    public function beginAction($id)
    {
        $task = $this->getDoctrine()->getManager()->getRepository(Task::class)->find($id);

        $this->denyAccessUnlessGranted('change_status', $task);

        $task->beginWork();

        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', 'Task was started by '.$this->getUser()->getUsername());

        return $this->redirectToRoute('task_view', ['id' => $task->id()]);
    }

    /**
     * @Route("/{id}/finish", name="task_finish")
     * @Method({"POST", "GET"})
     */
    public function finishAction($id)
    {
        $task = $this->getDoctrine()->getManager()->getRepository(Task::class)->find($id);

        $this->denyAccessUnlessGranted('change_status', $task);

        $task->finishWork();

        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', 'Task was finished by '.$this->getUser()->getUsername());

        return $this->redirectToRoute('task_view', ['id' => $task->id()]);
    }
}
