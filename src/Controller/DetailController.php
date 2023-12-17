<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\TourRequest;
use App\Form\TourRequestType;
use App\Repository\GalleryRepository;
use App\Repository\TourRepository;
use App\Repository\TourRequestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function display(
        TourRepository $tourRepository,
        $id,
        Tour $tour,
        Request $request,
        EntityManagerInterface $manager,
        GalleryRepository $galleryRepository
    ): Response {
        $tours = $tourRepository->findBy(['id' => $id]);
        $gallerys = $galleryRepository->findBy(['tour' => $id]);

        $tourRequest = new TourRequest();
        $tourRequest->setTour($tour);
        $form = $this->createForm(TourRequestType::class, $tourRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($tourRequest);
            $manager->flush();
            // dd($form->getData($ingerdient));

            return $this->redirectToRoute('detailThanks');
        }
        return $this->render('detail/index.html.twig', [
            'tours' => $tours,
            'gallerys' => $gallerys,
            'button' => 'Submit',
            'form' => $form->createView(),
        ]);
    }



    #[Route('/detail/request/sent', name: 'detail_thanks')]
    public function detailThanks(
        
    ): Response {
        
        return $this->render('detail/thanks.html.twig', [
            
        ]);
    }
}
