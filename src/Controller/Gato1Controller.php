<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Gato1Controller extends AbstractController
{
    #[Route('/gato1', name: 'gato1')]
    public function index(): Response
    {
        return $this->render('gato1/index.html.twig', [
            'controller_name' => 'Gato1Controller',
        ]);
    }
}
