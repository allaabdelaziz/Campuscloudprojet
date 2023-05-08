<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
       
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Votre message a etait bien envoye');

            $entityManager->persist($contact);
                $entityManager->flush();
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/index.html.twig', [
           
            'form' => $form->createView()
        ]);
    
    }
    
    #[Route('/mentions-legales', name: 'app_conditions', methods: ['GET', 'POST'])]
    public function conditions(): Response
    {

        return $this->render('home/conditionsU.html.twig', []);
    }


    #[Route('/politique-confidentialite', name: 'app_confidentialite', methods: ['GET', 'POST'])]
    public function contact(): Response
    {

        return $this->render('home/confidentialite.html.twig', []);
    }
}

