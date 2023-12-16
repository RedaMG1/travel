<?php

namespace App\Controller;

use App\Repository\GalleryRepository;
use App\Repository\TourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailController extends AbstractController
{
    #[Route('/detail', name: 'app_detail')]
    public function index(): Response
    {
        return $this->render('detail/index.html.twig', [
            'controller_name' => 'DetailController',
        ]);
    }

        #[Route('/detail/{id}', name: 'detail_display')]
        public function display(TourRepository $tourRepository,$id,
        GalleryRepository $galleryRepository): Response
        {
            $tours = $tourRepository->findBy(['id'=>$id]);
            $gallerys = $galleryRepository->findBy(['tour'=>$id]);

            return $this->render('detail/index.html.twig', [
                'tours' => $tours,
                'gallerys' => $gallerys,
            ]);
        }
}
