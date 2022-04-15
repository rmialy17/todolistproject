<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function loginAction(AuthenticationUtils $util): Response
    {
    
     
 
         // get the login error if there is one
         $error = $util->getLastAuthenticationError();
         // last username entered by the user
         $lastUsername = $util->getLastUsername();  
     
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
           
         if ($this->getUser()) { 
            return $this->redirectToRoute('homepage');
         }
      
    }     

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

   
}
