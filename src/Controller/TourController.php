<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Entity\TourRequest;
use App\Form\TourType;
use App\Repository\DayInfoRepository;
use App\Repository\GalleryRepository;
use App\Repository\TourRepository;
use App\Repository\TourRequestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class TourController extends AbstractController
{
    #[Route('/tour', name: 'app_tour')]
    public function index(TourRepository $tourRepository): Response
    {
        $tours = $tourRepository->findBy(['online' => 1]);
        return $this->render('tour/index.html.twig', [
            'tours' => $tours,
        ]);
    }

    // ----------------------------------------------------admin----------------------

    #[Route('/tour/admin', name: 'admin_tour')]
    public function adminIndex(
        TourRepository $tourRepository,
        PaginatorInterface $paginator,
        Request $request,

    ): Response {
        $tours = $paginator->paginate(
            $tourRepository->findAll(), // query
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('tour/admin/adminTours.html.twig', [
            'tours' => $tours,
        ]);
    }

    #[Route('/tour/create', name: 'create_tour')]
    public function adminTourCreate(
        Request $request,
        PaginatorInterface $paginator,
        EntityManagerInterface $manager,
        TourRepository $tourRepository,
        AuthorizationCheckerInterface $authorizationChecker
    ): Response {
        $tour = new Tour();
        $form = $this->createForm(TourType::class, $tour);

        $form->handleRequest($request);
        if (!$authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
            return $this->render('access_denied.html.twig');
        }
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($tour);
            $manager->flush();
            // dd($form->getData($ingerdient));
            $this->addFlash('success', 'a tour is created successfully!');
            return $this->redirectToRoute('adminTour');
        }
        return $this->render('tour/admin/create.html.twig', [

            'button' => 'Submit',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/tour/edit/{id}', name: 'edit_tour', methods: ['GET', 'POST'])]
    public function adminTourEdit(
        TourRepository $tourRepository,
        AuthorizationCheckerInterface $authorizationChecker,
        int $id,
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $tour = $tourRepository->findOneBy(['id' => $id]);
        $form = $this->createForm(TourType::class, $tour);
        $form->handleRequest($request);

        if (!$authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
            return $this->render('access_denied.html.twig');
        }
        if ($form->isSubmitted() && $form->isValid()) {

            $tour = $form->getData();

            $manager->persist($tour);
            $manager->flush();
            // dd($form->getData($product));
            $this->addFlash('success', 'the tour ' . $id . ' is edited successfully!');
            return $this->redirectToRoute('adminTour');
        }
        return $this->render('tour/admin/edit.html.twig', [

            'button' => 'Submit',
            'form' => $form->createView(),

        ]);
    }

    #[Route('/tour/delete/{id}', name: 'delete_tour', methods: ['GET', 'POST'])]
    public function delete(
        TourRepository $tourRepository,
        int $id,
        Request $request,TourRequestRepository $tourRequestRepository,
        EntityManagerInterface $manager,
        Tour $tour,GalleryRepository $galleryRepository,DayInfoRepository $dayInfoRepository,
        AuthorizationCheckerInterface $authorizationChecker
    ): Response {
        if (!$authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
            return $this->render('access_denied.html.twig');
        }
        $gallerys = $galleryRepository->findBy(['tour'=>$id]);
        $dayInfos = $dayInfoRepository->findBy(['tour'=>$id]);
        $tourRequests = $tourRequestRepository->findBy(['tour'=>$id]);
        
        foreach ($gallerys as $gallery) {
            $manager->remove($gallery);
        }
        foreach ($dayInfos as $dayInfo) {
            $manager->remove($dayInfo);
        }
        foreach ($tourRequests as $tourRequest) {
            $manager->remove($tourRequest);
        }
        $manager->remove($tour);
        $manager->flush();

        $this->addFlash('success', 'the tour has beign deleted successfully!');
        return $this->redirectToRoute('adminTour');
    }
}
