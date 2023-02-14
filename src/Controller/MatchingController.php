<?php

namespace App\Controller;

use Exception;
use App\Entity\User;
use App\Entity\Objet;
use App\Entity\Messages;
use App\Form\MatchingMessagesType;
use App\Repository\ObjetRepository;
use App\Repository\MessagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MatchingController extends AbstractController
{
    #[Route('/matching', name: 'app_matching')]
    public function index(ObjetRepository $objetRepository): Response
    {

        $objectsbycategories = [];
        $objectsbydetails = [];
        $objectCities = [];

        $objects = $objetRepository->findObjectsByUser($this->getUser());
        $othersLostObjects = $objetRepository->LostObjectsByOthers($this->getUser());

        $m = 0;
        foreach ($objects as $key => $mine) {

            $m++;
            foreach ($othersLostObjects as $key => $others) {

                if ($mine->getCategory()->getId() == $others->getCategory()->getId() && $mine->getCategoryDetails()->getId() == $others->getCategoryDetails()->getId() && $mine->getLostCity() == $others->getLostCity()) {
                    if (!in_array($others, $objectCities, true)) {
                        $objectCities[] =  $others;
                    }
                }
                if ($mine->getCategory()->getId() == $others->getCategory()->getId() && $mine->getCategoryDetails()->getId() == $others->getCategoryDetails()->getId()) {
                    if (!in_array($others, $objectsbydetails, true)) {
                        $objectsbydetails[] =  $others;
                    }
                }
                if (!in_array($others, $objectsbycategories, true) && $mine->getCategory()->getId() == $others->getCategory()->getId()) {
                    if (!in_array($others, $objectsbycategories, true)) {
                        $objectsbycategories[] =  $others;
                    }
                }
            }
        };

        $objectsbydetails  = array_diff($objectsbydetails, $objectCities);
        $objectsbycategories = array_diff($objectsbycategories, $objectsbydetails, $objectCities);

        return $this->render('matching/index.html.twig', [
            'objectsLostOthersByCategories' => $objectsbycategories,
            'objectsLostOthersByDetails' => $objectsbydetails,
            'objectsLostname' => $objectCities
        ]);
    }

    #[Route('/matching/{id}', name: 'matching_object_details')]
    public function Objectdetails(Objet $objet): Response
    {
        if ($objet->isStatus() == true && $objet->getUser() != $this->getUser()) {
            return $this->render('matching/matchingobjectdetails.html.twig', [
                'objet' => $objet,
            ]);
        }
        return $this->renderForm('pageNoFound/404.html.twig');
    }


    #[Route('/matching/send/{id}', name: 'app_messages_matching', methods: ['GET', 'POST'])]
    public function send(Request $request, EntityManagerInterface $entityManager, Objet $objet, SluggerInterface $slugger): Response
    {
       
        if ($objet->isStatus() == true && $objet->getUser() != $this->getUser()) {
            $message = new Messages();
            $form = $this->createForm(MatchingMessagesType::class, $message);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $this->addFlash('success', 'Votre message a etait bien envoye');
                $message->setSender($this->getUser());
                $message->setRecipient($objet->getUser()->getId());


                $imageobjet = $form->get('image')->getData();
                if ($imageobjet) {
                    $originalFilename = pathinfo($imageobjet->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageobjet->guessExtension();
                    try {
                        $imageobjet->move(
                            $this->getParameter('messageimage_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                    }
                    $message->setImage($newFilename);
                }

                $entityManager->persist($message);
                $entityManager->flush();
                return $this->redirectToRoute('app_matching', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('matching/matchingmessage.html.twig', [
                'message' => $message,
                'form' => $form,
            ]);
        }  return $this->renderForm('pageNoFound/404.html.twig');
    }
}
