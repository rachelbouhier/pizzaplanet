<?php

namespace App\Controller;

use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IngredientController extends AbstractController
{
    #[Route('/admin/ingredient/create', name: 'ingredient_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(IngredientType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $ingredient = $form->getData();

            $em->persist($ingredient);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $formView = $form->createView();
        
        return $this->render('ingredient/create.html.twig', [
            'formView' => $formView
        ]);
    }

    #[Route('/admin/ingredient/{id}/edit', name: 'ingredient_edit')]
    public function edit(string $id = null, IngredientRepository $ingredientRepository, Request $request, EntityManagerInterface $em): Response
    {
        $ingredient = $ingredientRepository->find($id);

        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->flush();

            return $this->redirectToRoute('dashboard_show');
        }

        $formView = $form->createView();

        return $this->render('ingredient/edit.html.twig',[
            'ingredient' => $ingredient,
            'formView' => $formView
        ]);
    }

    #[Route('/admin/ingredient/{id}/delete', name: 'ingredient_delete')]
    public function delete(string $id, IngredientRepository $ingredientRepository, EntityManagerInterface $em): Response
    {
        $ingredient = $ingredientRepository->find($id);
        
        $em->remove($ingredient);
        $em->flush();

        return $this->redirectToRoute('dashboard_show');
    }
}