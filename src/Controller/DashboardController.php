<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

// #[IsGranted('ROLE_USER')] -- controller protection method
final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    // public function index(): Response
    // {
    //     return new Response("Welcome to the dashboard! (Protected Area)");
    // }

    public function index(): Response
    {
        $user = $this->getUser();

        if ($this->isGranted('ROLE_ADMIN')) {
            $message = 'You are logged in as Admin. You have full access.';
        } else {
            $message = 'You are logged in as Regular User. Limited access granted.';
        }

        return $this->render('dashboard/index.html.twig', [
            'message' => $message,
            'username' => $user->getUserIdentifier(),
        ]);
    }
}
