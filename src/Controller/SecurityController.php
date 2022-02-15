<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
// https://symfony.com/doc/current/security/form_login_setup.html

class SecurityController extends AbstractController
{


    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder)
    {

        //$all = $request->query->all();
        $data = json_decode($request->getContent(), true);
        /*
        echo "<pre>";
        echo "aaaaaa";
        print_r($all);
        exit;
        */

        $username = $data["username"];
        $password = $data["password"];

        $user = $userRepository->loadUserByUsername($username);

        if (!$user) {
            return $this->json([
                'status' => 'User does not exist'
            ]);
        }

        $isGoodPass = $passwordEncoder->isPasswordValid($user, $password);

        if (!$isGoodPass) {
            return $this->json([
                'status' => 'password incorrect'
            ]);
        }

        return $this->json(
            [
                "status" => "logged",
                "msg" => "success",
            ]
        );
    }

    /**
     * @Route("/login33", name="app_login")
     */
    public function login33(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'security/login.html.twig',
            [
                'last_username' => $lastUsername,
                'error' => $error
            ]
        );
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {




        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}