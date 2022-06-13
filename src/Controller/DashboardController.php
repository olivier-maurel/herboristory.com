<?php

namespace App\Controller;

use App\Repository\PlantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(PlantRepository $plantRepository): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'plants' => $plantRepository->findAll(),
        ]);
    }
}
