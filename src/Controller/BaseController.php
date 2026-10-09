<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CategorieType;

final class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {

        return $this->render('base/index.html.twig', [
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $contact->setDateEnvoi(new \Datetime());
                $em->persist($contact);
                $em->flush();
                $this->addFlash('notice','Message envoyé');
                return $this->redirectToRoute('app_contact');
            }
            }
        return $this->render('base/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/apropos', name: 'app_apropos')]
    public function apropos(): Response
    {
        return $this->render('base/apropos.html.twig', [
        ]);
    }

    #[Route('/mentionlegal', name: 'app_mentionlegal')]
    public function mentionlegal(): Response
    {
        return $this->render('base/mentionlegal.html.twig', [
        ]);
    }
    #[Route('/categorie', name: 'app_categorie')]
    public function categorie(Request $crequest, EntityManagerInterface $em): Response
    {
        $categorie = new Categorie();
        $cform = $this->createForm(CategorieType::class, $categorie);
        if ($crequest->isMethod('POST')) {
            $cform->handleRequest($crequest);
            if ($cform->isSubmitted() && $cform->isValid()) {
                $em->persist($categorie);
                $em->flush();
                $this->addFlash('notice', 'Message envoyé');
                return $this->redirectToRoute('app_categorie');
            }
        }
        return $this->render('base/categorie.html.twig', [
            'cform' => $cform->createView(),
        ]);
}
}