<?php

namespace App\Controller;

use App\Entity\TourRequest;
use App\Repository\TourRequestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class TourRequestController extends AbstractController
{
    #[Route('/tour/request', name: 'app_tour_request')]
    public function index(): Response
    {
        return $this->render('tour_request/index.html.twig', [
            'controller_name' => 'TourRequestController',
        ]);
    }

    // ----------------------------------------------------admin----------------------

    #[Route('/tourRequest/admin', name: 'admin_tourRequest')]
    public function adminIndex(
        TourRequestRepository $tourRequestRepository,
        PaginatorInterface $paginator,
        Request $request,

    ): Response {
        $tourRequests = $paginator->paginate(
            $tourRequestRepository->findAll(), // query
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );


        return $this->render('tour_request/admin/adminTourRequest.html.twig', [
            'tourRequests' => $tourRequests,
        ]);
    }

    #[Route('/tour/delete/{id}', name: 'delete_tourRequest', methods: ['GET', 'POST'])]
    public function delete(
     
        EntityManagerInterface $manager,
        TourRequest $tourRequest,
        AuthorizationCheckerInterface $authorizationChecker
    ): Response {
        if (!$authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
            return $this->render('access_denied.html.twig');
        }
        $manager->remove($tourRequest);
        $manager->flush();

        $this->addFlash('success', 'the request has beign deleted successfully!');
        return $this->redirectToRoute('adminTourRequest');
    }
}
