<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Event\Model\RedirectEvent;
use Pimcore\Model\DataObject\Task;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TaskController extends FrontendController
{
    /**
     * @Template()
     */
    public function defaultAction(Request $request)
    {
        $taskListing = new Task\Listing();
        $tasks = $taskListing->getObjects();

        $params = ['tasks' => $tasks];

        return $this->renderTemplate('Task/default.html.twig', $params);
    }

    public function addTaskAction(Request $request)
    {
        $newTask = new Task();
        $newTask->setTitle($request->request->get('title'));
        $newTask->setKey($request->request->get('title'));
        $newTask->setParentId(1);
        $newTask->setPublished(true);
        $newTask->setStatus(false);
        $newTask->save();

        return new RedirectResponse('/tasks');
    }

    public function updateTaskAction(Request $request)
    {
        $taskById = Task::getById($request->request->get('id'));
        $taskById->setTitle($request->request->get('title'));
        $taskById->setStatus($request->request->has('status'));
        $taskById->save();

        return new RedirectResponse('/tasks');
    }

    public function deleteTaskAction(Request $request)
    {
        $taskById = Task::getById($request->request->get('id'));
        $taskById->delete();

        return new RedirectResponse('/tasks');
    }
}
