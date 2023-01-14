<?php

namespace App\Controller;

use App\Form\DashboardIngredientType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'dashboard_show')]
    public function show(): Response
    {
        $form = $this->createForm(DashboardIngredientType::class);

        $formView = $form->createView();

        return $this->render('dashboard.html.twig', [
            'formView' => $formView
        ]);
    }
}
