<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LuckyController extends AbstractController
{
    #[Route('/lucky/number', name: 'app_lucky')]
    public function index(): Response {
        $number = random_int(1,100);
        return $this->render('lucky/index.html.twig', [
            'controller_name' => 'LuckyController',
            'number' => $number,
            'name'=>"ahmed"
        ]);
    }
}
