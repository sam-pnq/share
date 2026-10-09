<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;

class CategorieController extends AbstractController
{
    #[Route('/liste-categorie', name: 'app_liste_categorie')]
    public function listeCategorie(CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->findAll();
        return $this->render('categorie/liste-categorie.html.twig', ['categorie' => $categorie
        ]);
    }
}