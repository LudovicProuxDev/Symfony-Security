<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

final class AdminController extends AbstractController
{
    #[Route('/users', name: 'app_users', methods: ['GET'])]
    public function users(UserRepository $userRepository): Response
    {
        return $this->render('admin/users.html.twig', [
            'title' => 'Users',
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/users/edit/{id}', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function userEdit(Request $request, EntityManagerInterface $entityManager, ?User $user): Response
    {
        if (!$user) {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/user_edit.html.twig', [
            'title' => 'Edit',
            'user' => $user,
            'form' => $form,
        ]);
    }
}
