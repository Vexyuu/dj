<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DjController extends AbstractController
{
    #[Route('/dj', name: 'app_dj')]
    public function index(): Response
    {
        return $this->render('dj/index.html.twig', [
            'controller_name' => 'DjController',
        ]);
    }
}
