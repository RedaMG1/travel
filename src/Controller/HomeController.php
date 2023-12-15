<?php

namespace App\Controller;

use App\Repository\TourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(TourRepository $tourRepository): Response
    {
        $tours = $tourRepository->findBy(['online'=>1]);
        return $this->render('home/index.html.twig', [
            'tours'=>$tours,
            'controller_name' => 'HomeController',
        ]);
    }
}
