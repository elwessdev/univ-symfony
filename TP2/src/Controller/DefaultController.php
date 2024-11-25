<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    // Main
    #[Route('/', name: 'app_default')]
    public function index(): Response
    {
        return new Response("<html><body>Bienvenue dans Symfony !</body></html>");
    }
    // Hello
    #[Route('/hello', name: 'hello')]
    public function hello(): Response
    {
        return new Response("<html><body>Hello Symfony!</body></html>");
    }
}