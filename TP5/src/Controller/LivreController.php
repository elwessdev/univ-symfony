<?php

namespace App\Controller;

// src/Controller/LivreController.php
use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivreController extends AbstractController
{
    // HOme Redirect To livre page
    #[Route("/", name:"home")]
    public function home(){
        return $this->redirectToRoute("app_livre_liste");
    }
    // Afficher tous les livres
    #[Route('/livres', name: 'app_livre_liste')]
    public function index(EntityManagerInterface $entityManager): Response {
        $livres = $entityManager->getRepository(Livre::class)->findAll();
        return $this->render('livre/index.html.twig', ['livres' => $livres]);
    }

    // Ajouter un livre
    #[Route('/livres/ajouter', name: 'app_livre_ajouter', methods: ['POST', 'GET'])]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response {
        if ($request->isMethod('POST')) {
            $livre = new Livre();
            $livre->setTitre($request->request->get('titre'));
            $livre->setAuteur($request->request->get('auteur'));
            $livre->setDescription($request->request->get('description'));
            $livre->setDateDePublication(new \DateTime($request->request->get('datePublication')));

            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('app_livre_liste');
        }
        return $this->render('livre/ajouter.html.twig');
    }
    // Details
    #[Route('/livres/{id}', name: 'app_livre_details')]
    public function details(Livre $livre): Response {
        return $this->render('livre/details.html.twig', ['livre' => $livre]);
    }
    // supprimer
    #[Route('/livres/supprimer/{id}', name: 'app_livre_supprimer')]
    public function supprimer(Livre $livre, EntityManagerInterface $entityManager): Response {
        $entityManager->remove($livre);
        $entityManager->flush();
        return $this->redirectToRoute('app_livre_liste');
    }
}
