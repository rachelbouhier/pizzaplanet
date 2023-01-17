<?php

namespace App\Controller;

use App\Form\PizzaType;
use App\Form\RetrievePizzaIdType;
use App\Repository\PizzaRepository;
use App\Services\PizzaPriceCalculator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PizzaController extends AbstractController
{
    #[Route('/admin/pizza/create', name: 'pizza_create')]
    public function create(Request $request, PizzaPriceCalculator $pizzaPriceCalculator, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(PizzaType::class);    

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $pizza = $form->getData();
            
            $pizzaPrice = $pizzaPriceCalculator->calculate($pizza);

            $pizza->setPrice($pizzaPrice);

            $em->persist($pizza);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $formView = $form->createView();
        
        return $this->render('pizza/create.html.twig', [
            'formView' => $formView,
            'currentUser' => $user
        ]);
    }

    #[Route('/admin/pizza/edit', name: 'pizza_getIdToEdit')]
    public function getIdToEdit(string $id = null, PizzaRepository $pizzaRepository, Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(RetrievepizzaIdType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $id = ($form->getData()['pizza']);
        
            return $this->redirectToRoute('pizza_edit', ['id' => $id]);
        }

        $formView = $form->createView();

        return $this->render('pizza/idToEdit.html.twig', [
            'formView' => $formView,
            'currentUser' => $user
        ]);
    }

    #[Route('/admin/pizza/{id}/edit', name: 'pizza_edit')]
    public function edit(string $id = null, PizzaRepository $pizzaRepository, PizzaPriceCalculator $pizzaPriceCalculator, Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $pizza = $pizzaRepository->find($id);

        $form = $this->createForm(pizzaType::class, $pizza);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $pizzaPrice = $pizzaPriceCalculator->calculate($pizza);

            $pizza->setPrice($pizzaPrice);
            $em->flush();

            return $this->redirectToRoute('dashboard_show');
        }

        $formView = $form->createView();

        return $this->render('pizza/edit.html.twig',[
            'pizza' => $pizza,
            'formView' => $formView,
            'currentUser' => $user
        ]);
    }

    #[Route('/admin/pizza/delete', name: 'pizza_getIdToDelete')]
    public function getIdToDelete(string $id = null, pizzaRepository $pizzaRepository, Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(RetrievePizzaIdType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $id = ($form->getData()['pizza']);
        
            return $this->redirectToRoute('pizza_delete', ['id' => $id]);
        }

        $formView = $form->createView();

        return $this->render('pizza/idToDelete.html.twig', [
            'formView' => $formView,
            'currentUser' => $user
        ]);
    }

    #[Route('/admin/pizza/{id}/delete', name: 'pizza_delete')]
    public function delete(string $id, PizzaRepository $pizzaRepository, EntityManagerInterface $em): Response
    {
        $pizza = $pizzaRepository->find($id);
        
        $em->remove($pizza);
        $em->flush();

        return $this->redirectToRoute('dashboard_show');
    }
}
