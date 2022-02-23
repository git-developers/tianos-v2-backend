<?php

namespace App\Controller;

use App\Entity\Gato3;
use App\Form\Gato3Type;
use App\Repository\Gato3Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gato3')]
class Gato3Controller extends AbstractController
{
    #[Route('/', name: 'gato3_index', methods: ['GET'])]
    public function index(Gato3Repository $gato3Repository): Response
    {
        return $this->render('gato3/index.html.twig', [
            'gato3s' => $gato3Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'gato3_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $gato3 = new Gato3();
        $form = $this->createForm(Gato3Type::class, $gato3);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($gato3);
            $entityManager->flush();

            return $this->redirectToRoute('gato3_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gato3/new.html.twig', [
            'gato3' => $gato3,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'gato3_show', methods: ['GET'])]
    public function show(Gato3 $gato3): Response
    {
        return $this->render('gato3/show.html.twig', [
            'gato3' => $gato3,
        ]);
    }

    #[Route('/{id}/edit', name: 'gato3_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Gato3 $gato3, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Gato3Type::class, $gato3);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('gato3_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gato3/edit.html.twig', [
            'gato3' => $gato3,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'gato3_delete', methods: ['POST'])]
    public function delete(Request $request, Gato3 $gato3, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gato3->getId(), $request->request->get('_token'))) {
            $entityManager->remove($gato3);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gato3_index', [], Response::HTTP_SEE_OTHER);
    }
}
