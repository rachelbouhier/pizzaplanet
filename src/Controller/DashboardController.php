<?php

namespace App\Controller;

use App\Form\DashboardIngredientType;
use Doctrine\Migrations\Exception\DuplicateMigrationVersion;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'dashboard_show')]
    public function show(Request $request): Response
    {
        $form = $this->createForm(DashboardIngredientType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $id = ($form->getData()['ingredient']);
            
            return $this->redirectToRoute('ingredient_delete', ['id' => $id]);
        }

        $formView = $form->createView();

        return $this->render('dashboard.html.twig', [
            'formView' => $formView
        ]);
    }
}
