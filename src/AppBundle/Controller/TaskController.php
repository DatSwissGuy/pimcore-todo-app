<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\TaskType;
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

        $form = $this->createForm(TaskType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->addTaskAction($form);

            return new RedirectResponse('/tasks');
        }

        $renderParams = [
            'tasks' => $tasks,
            'form' => $form->createView()
        ];

        return $this->renderTemplate('Task/default.html.twig', $renderParams);
    }

    private function addTaskAction($form): void
    {
        $newTask = new Task();
        $newTask->setTitle($form['title']->getData());
        $newTask->setKey($form['title']->getData());
        $newTask->setParentId(1);
        $newTask->setPublished(true);
        $newTask->setStatus(false);
        $newTask->save();
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
