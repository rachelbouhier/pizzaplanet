<?php

namespace App\Controller;

use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    #[Route('/', name: 'homepage')]
    public function homepage(PizzaRepository $pizzaRepository) {
        
        $pizzas = $pizzaRepository->findAll();
        
        return $this->render('home.html.twig', [
            'pizzas' => $pizzas
        ]);
    }
}