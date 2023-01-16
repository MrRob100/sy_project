<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrangeElephantController extends AbstractController
{
    #[Route('/orange/elephant', name: 'app_orange_elephant')]
    public function index(): Response
    {
        return $this->render('orange_elephant/index.html.twig', [
            'controller_name' => 'OrangeElephantController',
        ]);
    }

    #[Route('/shot/{name}', name: 'shots', methods: ['GET', 'HEAD'])]
    public function get($name): Response
    {
        return $this->json([
            'message' => $name
        ]);
    }
}
