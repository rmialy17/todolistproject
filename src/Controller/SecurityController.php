<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction (AuthenticationUtils $util): Response
    {

        return $this->render('security/login.html.twig', [
            "lastUserName" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError(),   
        ]);

        $this->addFlash('success', "Connexion réussie.");
        return $this->redirectToRoute('homepage');
    }

    // /**
    //  * @Route("/login_check", name="login_check")
    //  */
    // public function loginCheck()
    // {
    //     // This code is never executed.
    // }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutCheck()
    {
        // This code is never executed.
    }
}
