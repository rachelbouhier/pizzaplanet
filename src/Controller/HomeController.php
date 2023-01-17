<?php

namespace App\Controller;

use App\Repository\PizzaRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    #[Route('/', name: 'homepage')]
    public function homepage(PizzaRepository $pizzaRepository) {
        
        $user = $this->getUser();
        $pizzas = $pizzaRepository->findAll();
        
        if ($this->denyAccessUnlessGranted('ROLE_USER')) {
            return $this->render('login.html.twig', []);
        }
        
        if (in_array("ROLE_ADMIN", $user->getRoles())) {
            return $this->render('dashboard.html.twig', [
                'currentUser' => $user
            ]);
        }
        return $this->render('home.html.twig', [
            'pizzas' => $pizzas,
            'currentUser' => $user
        ]);
    }
}