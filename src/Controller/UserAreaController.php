<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use App\Form\ChangePasswordFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[
    Route('/user'),
    IsGranted("ROLE_USER"),
]

class UserAreaController extends AbstractController
{
    #[Route('/profile', name: 'app_user_profile')]
    public function index(): Response
    {
        return $this->render('user_area/userprofile.html.twig', [
           
        ]);
    }

    #[Route(' profil/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function editprofile(Request $request, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_user_area', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_area/edituserprofile.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/reset/{id}', name: 'app_reset_password_profile')]
    public function reset(Request $request, UserPasswordHasherInterface $userPasswordHasher, User $user, UserRepository $usersRepository): Response
    {

        // The token is valid; allow the user to change their password.
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Votre mot de passe a été modifié');

            $encodedPassword = $userPasswordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            );
            $user->setPassword($encodedPassword);
            $usersRepository->add($user);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('reset_password/reset.html.twig', [
            'resetForm' => $form->createView(),
        ]);
    }



}
