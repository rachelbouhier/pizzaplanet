<?php

namespace App\Controller;

use App\Form\PizzaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PizzaController extends AbstractController
{
    #[Route('/admin/pizza/create', name: 'pizza_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PizzaType::class);    

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $pizza = $form->getData();
            $em->persist($pizza);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $formView = $form->createView();
        
        return $this->render('pizza/create.html.twig', [
            'formView' => $formView
        ]);
    }
}
