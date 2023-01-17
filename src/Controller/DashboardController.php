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
    public function show(): Response
    {
        $user = $this->getUser();

        return $this->render('dashboard.html.twig', [
            'currentUser' => $user
        ]);
    }
}
