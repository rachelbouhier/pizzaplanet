<?php

namespace App\Controller;

use App\DataFixtures\PizzaFixtures;
use App\Repository\PizzaRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    #[Route('/', name: 'homepage')]
    public function homepage(PizzaRepository $pizzaRepository) {
        
        $user = $this->getUser();
        $pizzas = $pizzaRepository->findAll();
        
        if ($this->denyAccessUnlessGranted('ROLE_USER')) {
            return $this->render('login.html.twig', []);
        }
        
        return $this->render('home.html.twig', [
            'pizzas' => $pizzas,
            'currentUser' => $user
        ]);
    }
}