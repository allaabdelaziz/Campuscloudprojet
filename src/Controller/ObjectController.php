<?php

namespace App\Controller;

use App\Entity\Objet;
use App\Form\NewObjectType;
use App\Repository\UserRepository;
use App\Repository\ObjetRepository;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


#[
    Route('/objet'),
    IsGranted("ROLE_USER"),
]



class ObjectController extends AbstractController
{
    #[Route('/new', name: 'app_newobject', methods: ['GET', 'POST'])]
    public function newobject(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {

        $objet = new Objet();
        $form = $this->createForm(NewObjectType::class, $objet);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash('success', 'vous avez ajouter un new object');
            $objet->setUser($this->getUser());
            $objet->setIsFound(false);
            $objet->setActive(true);

            $imageobjet = $form->get('image')->getData();
            if ($imageobjet) {
                $originalFilename = pathinfo($imageobjet->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageobjet->guessExtension();
                try {
                    $imageobjet->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $objet->setImage($newFilename);
            }

            // $ObjetRepository->persist($objet);
            $entityManager->persist($objet);
            $entityManager->flush();

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('object/new.html.twig', [

            'form' => $form,

        ]);
    }



    #[Route('/', name: 'app__profileobject')]
    public function userObject(UserRepository $userRepository, ObjetRepository $objetRepository): Response
    {

        $findObjects = $objetRepository->findByUser($this->getUser());
        $lostObjects = $objetRepository->lostByUser($this->getUser());
        return $this->render('object/userObjects.html.twig', [
            'users' => $userRepository->findAll(),
            'objectsFound' =>  $findObjects,
            'objectsLost' =>  $lostObjects,
        ]);
    }



    //////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('/{id}', name: 'app_objectdetails' ) ]
    public function Objectdetails(Objet $objet): Response
    {
        if ($objet->getUser() == $this->getUser()) {

            return $this->render('object/objectdetails.html.twig', [
                'objet' => $objet,

            ]);
        }
        return $this->renderForm('pageNoFound/404.html.twig');
    }


    #[Route('/{id}/edit', name: 'app_objectedit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Objet $objet, ObjetRepository $objetRepository, SluggerInterface $slugger, EntityManagerInterface $entityManager,): Response
    {
        if ($objet->getUser() == $this->getUser()) {

            $img = $objet->getImage();
            $form = $this->createForm(NewObjectType::class, $objet);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {

                $imageobjet = $form->get('image')->getData();


                if (!empty($imageobjet)) {

                    $originalFilename = pathinfo($imageobjet->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageobjet->guessExtension();
                    try {
                        $imageobjet->move(
                            $this->getParameter('image_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                    }
                    $objet->setImage($newFilename);
                } else {
                    $objet->setImage($img);
                }

                $entityManager->persist($objet);
                $entityManager->flush();
                return $this->redirectToRoute('app__profileobject', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('object/edit.html.twig', [
                'sub_category' => $objet,
                'form' => $form,
            ]);
        }
        return $this->renderForm('pageNoFound/404.html.twig');
    }
}
