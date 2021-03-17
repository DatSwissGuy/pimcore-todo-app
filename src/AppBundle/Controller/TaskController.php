<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Task;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends FrontendController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function defaultAction(Request $request): Response
    {
        $taskListing = new Task\Listing();
        $tasks = $taskListing->getObjects();

        $params = ['tasks' => $tasks];

        return $this->renderTemplate('Task/default.html.twig', $params);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function addTaskAction(Request $request): RedirectResponse
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

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateTaskAction(Request $request): RedirectResponse
    {
        $taskById = Task::getById($request->request->get('id'));
        $taskById->setTitle($request->request->get('title'));
        $taskById->setStatus($request->request->has('status'));
        $taskById->save();

        return new RedirectResponse('/tasks');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteTaskAction(Request $request): RedirectResponse
    {
        $taskById = Task::getById($request->request->get('id'));
        $taskById->delete();

        return new RedirectResponse('/tasks');
    }
}
