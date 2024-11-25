<?php

namespace App\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
//
// use App\Entity\Task;
// use Symfony\Component\HttpFoundation\Request;
// use Doctrine\ORM\EntityManagerInterface;

class TodoController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    #[Route('/', name: "home_page")]
    public function index(): Response {
        $tasks = $this->em->getRepository(Task::class)->findAll();
        // print_r($tasks);
        return $this->render("index.html.twig", ["tasks" => $tasks]);
    }

    #[Route('/add', name: "add_task", methods: ["POST"])]
    public function addTask(Request $req): Response {
        if ($req->isMethod("POST")) {
            $task = new Task();
            $task->setContent($req->request->get("task"));
            $task->setCompleted(false);
            $this->em->persist($task);
            $this->em->flush();
        }
        return $this->redirectToRoute('home_page');
    }

    #[Route('/delete/{id}', name: "delete_task")]
    public function deleteTask(Task $task): Response {
        $this->em->remove($task);
        $this->em->flush();
        return $this->redirectToRoute('home_page');
    }

    #[Route('/edit/{id}', name: "edit_task")]
    public function editTask(Request $req, Task $task): Response {
        // if($req->isMethod("POST")){
        //     $task = $this->em->getRepository(Task::class)->find($req->request->get("id"));
        //     $task->setContent($req->request->get("modifTask"));
        //     $this->em->persist($task);
        //     $this->em->flush();
        // }
        $task->setContent($req->request->get("modifTask"));
        $this->em->persist($task);
        $this->em->flush();
        return $this->redirectToRoute('home_page');
    }

    #[Route('/done/{id}', name: "done_task")]
    public function doneTask(Task $task, Request $req): Response {
        $completed = $req->request->get('completed', null);
        $task->setCompleted($completed !== null);
        $this->em->persist($task);
        $this->em->flush();
        return $this->redirectToRoute('home_page');
    }
}
