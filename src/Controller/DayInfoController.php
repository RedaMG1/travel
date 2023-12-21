<?php

namespace App\Controller;

use App\Entity\DayInfo;
use App\Form\DayInfoType;
use App\Repository\DayInfoRepository;
use App\Repository\TourRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class DayInfoController extends AbstractController
{
    #[Route('/day/info', name: 'app_day_info')]
    public function index(): Response
    {
        return $this->render('day_info/index.html.twig', [
            'controller_name' => 'DayInfoController',
        ]);
    }

    // ----------------------------------------------------admin----------------------

    #[Route('/dayInfo/admin', name: 'admin_dayInfo')]
    public function adminIndexTour(

        TourRepository $tourRepository,
    ): Response {
        $tours = $tourRepository->findAll();
        return $this->render('day_info/admin/adminTours.html.twig', [
            'tours' => $tours,
        ]);
    }

    #[Route('/dayInfo/admin/{id}', name: 'admin_dayInfo')]
    public function adminIndex(

        PaginatorInterface $paginator,
        Request $request,$id,
        DayInfoRepository $dayInfoRepository,

    ): Response {
        $dayInfos = $paginator->paginate(
            $dayInfoRepository->findBy(['tour'=>$id]), // query
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );


        return $this->render('day_info/admin/adminDayInfo.html.twig', [
            'dayInfos' => $dayInfos,
        ]);
    }

    #[Route('/dayInfo/create', name: 'create_dayInfo')]
    public function adminDayInfoCreate(
        Request $request,
        PaginatorInterface $paginator,
        EntityManagerInterface $manager,

        AuthorizationCheckerInterface $authorizationChecker
    ): Response {
        $dayInfo = new DayInfo();
        $form = $this->createForm(DayInfoType::class, $dayInfo);

        $form->handleRequest($request);
        if (!$authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
            return $this->render('access_denied.html.twig');
        }
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($dayInfo);
            $manager->flush();
            // dd($form->getData($ingerdient));
            $this->addFlash('success', 'a DayInfo is created successfully!');
            return $this->redirectToRoute('adminDayInfo');
        }
        return $this->render('day_info/admin/create.html.twig', [

            'button' => 'Submit',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/dayInfo/edit/{id}', name: 'edit_dayInfo', methods: ['GET', 'POST'])]
    public function adminDayInfoEdit(
        DayInfoRepository $dayInfoRepository,
        AuthorizationCheckerInterface $authorizationChecker,
        int $id,
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $dayInfo = $dayInfoRepository->findOneBy(['id' => $id]);
        $form = $this->createForm(DayInfoType::class, $dayInfo);
        $form->handleRequest($request);

        if (!$authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
            return $this->render('access_denied.html.twig');
        }
        if ($form->isSubmitted() && $form->isValid()) {

            $dayInfo = $form->getData();

            $manager->persist($dayInfo);
            $manager->flush();
            // dd($form->getData($product));
            $this->addFlash('success', 'the day ' . $id . ' is edited successfully!');
            return $this->redirectToRoute('adminDayInfo');
        }
        return $this->render('day_info/admin/edit.html.twig', [

            'button' => 'Submit',
            'form' => $form->createView(),

        ]);
    }

    #[Route('/dayInfo/delete/{id}', name: 'delete_dayInfo', methods: ['GET', 'POST'])]
    public function delete(

        int $id,
        Request $request,
        EntityManagerInterface $manager,
        DayInfo $dayInfo,
        AuthorizationCheckerInterface $authorizationChecker
    ): Response {
        if (!$authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
            return $this->render('access_denied.html.twig');
        }
        $manager->remove($dayInfo);
        $manager->flush();

        $this->addFlash('success', 'the day has beign deleted successfully!');
        return $this->redirectToRoute('adminDayInfo');
    }
}
