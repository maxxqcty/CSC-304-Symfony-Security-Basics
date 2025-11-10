<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    #[IsGranted('ROLE_USER')] // ensures only users with ROLE_USER (or ROLE_ADMIN via hierarchy) can access
    public function index(): Response
    {
        $user = $this->getUser();

        $message = $this->isGranted('ROLE_ADMIN')
            ? 'You are logged in as Admin. You have full access.'
            : 'You are logged in as Regular User. Limited access granted.';

        return $this->render('dashboard/index.html.twig', [
            'message' => $message,
            'username' => $user->getUserIdentifier(),
        ]);
    }
}
