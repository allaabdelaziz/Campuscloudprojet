<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Repository\MessagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[
    Route('/message'),

    IsGranted("ROLE_USER"),
]


class MessagesController extends AbstractController
{
    #[Route('/messagesreçus', name: 'app_messages_recu', methods: ['GET'])]
    public function indexrecu(MessagesRepository $messagesRepository): Response
    {
        return $this->render('messages/messageRecu.html.twig', [
            'messages' => $messagesRepository->findby(
                array(),
                array('created_at' => 'ASC')
            ),
        ]);
    }

    #[Route('/messagesenvoyes', name: 'app_messages_envoyes', methods: ['GET'])]
    public function indexenvoi(MessagesRepository $messagesRepository): Response
    {

        return $this->render('messages/messageEnvo.html.twig', [
            'messages' => $messagesRepository->findby(
                array(),
                array('title' => 'ASC')
            ),
        ]);
    }
    #[Route('/new', name: 'app_messages_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MessagesRepository $messagesRepository): Response
    {
        $message = new Messages();
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Votre message a etait bien envoye');
            $message->setSender($this->getUser());
            $messagesRepository->add($message);
            return $this->redirectToRoute('app_messages', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('messages/new.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_messages_show', methods: ['GET'])]
    public function show(Messages $message,   EntityManagerInterface $entityManager): Response
    {
        $message->setisread(true);

        $entityManager->persist($message);
        $entityManager->flush();
        return $this->render('messages/show.html.twig', [
            'message' => $message,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_messages_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Messages $message, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($message);
            $entityManager->flush();
            return $this->redirectToRoute('app_messages_recu', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('messages/edit.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_messages_delete', methods: ['POST'])]
    public function delete(Request $request, Messages $message,  EntityManagerInterface $entityManager): Response
    {

        if ($this->isCsrfTokenValid('delete' . $message->getId(), $request->request->get('_token'))) {
            $entityManager->remove($message);
            $entityManager->flush();
        }
        if ($message->getSender()->getId() == $this->getUser()->getId()) {
            return  $this->redirectToRoute('app_messages_envoyes', [], Response::HTTP_SEE_OTHER);
        }else {
            return  $this->redirectToRoute('app_messages_recu', [], Response::HTTP_SEE_OTHER);
        }
    }
}
