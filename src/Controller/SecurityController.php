<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'security_login')]
    public function login(): Response
    {
        $loginForm = $this->createForm(LoginType::class);

        return $this->render('login.html.twig', [
            'loginFormView' => $loginForm->createView()
        ]);
    }

    #[Route('/logout', name: 'security_logout')]
    public function logout(){
    }
}
