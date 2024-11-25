<?php

namespace App\Controller;

use App\Entity\Films;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FilmsController extends AbstractController {
    private $emi;
    public function __construct(EntityManagerInterface $em) {
        $this->emi = $em;
    }

    #[Route('/', name: 'app_films')]
    public function index(): Response {
        $films = $this->emi->getRepository(Films::class)->findAll();
        return $this->render("Films/index.html.twig",["films"=>$films]);
    }

    #[Route('/ajouter', name: 'ajout_films', methods: ["POST","GET"])]
    public function ajoutFilm(Request $req): Response {
        if($req->isMethod("POST")){
            $film = new Films();
            $film->setTitre($req->request->get("titre"));
            $film->setRealisateur($req->request->get("realisateur"));
            $film->setDateSortie(new \DateTime($req->request->get("date_sortie")));
            $film->setGenre($req->request->get("genre"));
            $this->emi->persist($film);
            $this->emi->flush();
            return $this->redirectToRoute("ajout_films");
        }
        return $this->render("Films/add.html.twig");
    }

    #[Route('/supprimer/{id}', name: 'supp_film')]
    public function supprimerFilm(Films $film): Response {
        $this->emi->remove($film);
        $this->emi->flush();
        return $this->redirectToRoute("app_films");
    }

    #[Route('/details/{id}', name: 'details_film')]
    public function detailsFilm(Films $film): Response {
        return $this->render("Films/details.html.twig",["film"=>$film]);
    }
}
