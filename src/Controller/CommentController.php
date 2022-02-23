<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\User;
use App\Form\CommentType;
use App\Form\UserLoginType;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
/**
 * @Route("/comment_api")
 */
class CommentController extends AbstractController
{

    /**
     * @Route("/comments", name="list", methods={"GET", "POST"})
     */
    public function index(EntityManagerInterface $entityManager, CommentRepository $CommentRepository): Response
    {
        $comments = $CommentRepository->findAll();

        $count = count($comments);



        /*

        $serializer = $this->container->get('jms_serializer');

        return $serializer->serialize(
            $object,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups([$groupName])
        );
        */



        $out = [];
        foreach ($comments as $value) {
            $comment = $value->getComment();
            $out[]= [
                "comment" => $comment
            ];
        }


        return $this->json(
            [
                "status" => "3",
                "statusHttp" => "200",
                "message" => "server error",
                "items" => $out
            ]
        );
    }



    /**
     * @Route("/list2", name="list2", methods={"POST"})
     */
    public function index2(EntityManagerInterface $entityManager, CommentRepository $CommentRepository): Response
    {
        $comments = $entityManager
            ->getRepository(Comment::class)
            ->findAll();

        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
        ]);

    }

    /*
    public function comment(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository, CommentRepository $CommentRepository): Response
    {
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
        }

        if (!$request->isMethod('POST')) {
            return $this->json([
                'error' => 'NOT_POST'
            ]);
        }

        $data = $request->query->all();

        $comment = new Comment();

        //$user = $userRepository->loadUserByUsername("prueba3");
        $form = $this->createForm(CommentType::class, $comment);
        $form->submit($data, false);


        if ($form->isSubmitted() && $form->isValid()) {


            if ($data['username'] == 'tianos_admin') {
                $user->setRoles([User::ROLE_ADMIN]);
            } else {
                $user->setRoles([User::ROLE_TIANOS]);
            }


            //$encoded = $encoder->encodePassword($user, $data['password']);
            $user = $userRepository->loadUserByUsername("prueba3");
            $comment->setUser($user);
            echo "holaa";
            $comment->setComment($data['comment']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
        }
        print_r($comment);

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);


        return $this->json([
            "status" => "1",
            "msg" => "success",
        ]);
    }
    */
/*
    #[Route('/{id}', name: 'comment_show', methods: ['GET'])]
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    #[Route('/{id}/edit', name: 'comment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'comment_delete', methods: ['POST'])]
    public function delete(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comment_index', [], Response::HTTP_SEE_OTHER);
    }
*/

    /**
     * @Route("/comment", name="comment_comment", methods={"GET", "POST"})
     */

    public function new(Request $request,UserRepository $userRepository, EntityManagerInterface $entityManager, CommentRepository $CommentRepository): Response
    {

        $comment = new Comment();
        $form = $this->createForm(commentType::class, $comment);
        $form->handleRequest($request);
        $data = json_decode($request->getContent(), true);

        $user = $userRepository->loadUserByUsername("prueba3");

        $comment->setUser($user);
        $comment->setComment($data["comment"]);

        $errors = [];

        foreach ($form->getErrors() as $key => $error) {
            if ($form->isRoot()) {
                $errors[$error->getOrigin()->getName()][] = $error->getMessage();
            } else {
                $errors[$error->getOrigin()->getName()] = $error->getMessage();
            }
        }

        //exit;


        if (count($errors) > 0) {
            return $this->json($errors);
        }

        //if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($comment);
            $entityManager->flush();
            print_r($comment);
            //return $this->redirectToRoute('comment_index', [], Response::HTTP_SEE_OTHER);
        //}

        /*
        return $this->render('comment/new.html.twig', [
            'gato3' => $comment,
            'form' => $form->createView(),
        ]);
        */


        return $this->json([
            "status" => "1",
            "msg" => "success",
        ]);
    }
}
