<?php

namespace App\Controller;
use App\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
  #[Route('/user', name: 'user')]
  public function index(): Response{
      $usersData = [
        new User('ahmed', 'john@example.com', 'securepassword','this is Osama there'),
        new User('sami', 'john@example.com', 'securepassword','this is Osama there'),
        new User('rami', 'john@example.com', 'securepassword','this is Osama there'),
        new User('osama', 'john@example.com', 'securepassword','this is Osama there')
      ];
      return $this->render('user.html.twig',[
        "usersData" => $usersData
      ]);
  }
}




