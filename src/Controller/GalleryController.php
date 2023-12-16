<?php

namespace App\Controller;

use App\Entity\Gallery;
use App\Form\GalleryType;
use App\Repository\GalleryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class GalleryController extends AbstractController
{
    #[Route('/gallery', name: 'app_gallery')]
    public function index(): Response
    {
        return $this->render('gallery/index.html.twig', [
            'controller_name' => 'GalleryController',
        ]);
    }
    // --------------------------------admin--------------
    #[Route('/gallery/admin', name: 'admin_gallery')]
    public function adminIndex(
        GalleryRepository $galleryRepository,
        PaginatorInterface $paginator,
        Request $request,

    ): Response {
        $gallerys = $paginator->paginate(
            $galleryRepository->findAll(), // query
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );


        return $this->render('gallery/admin/adminGallery.html.twig', [
            'gallerys' => $gallerys,
        ]);
    }

    #[Route('/gallery/create', name: 'create_gallery')]
    public function adminTourCreate(
        Request $request,
        PaginatorInterface $paginator,
        EntityManagerInterface $manager,
        GalleryRepository $galleryRepository,
        AuthorizationCheckerInterface $authorizationChecker
    ): Response {
        $gallery = new Gallery();
        $form = $this->createForm(GalleryType::class, $gallery);

        $form->handleRequest($request);
        if (!$authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
            return $this->render('access_denied.html.twig');
        }
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($gallery);
            $manager->flush();
            // dd($form->getData($ingerdient));
            $this->addFlash('success', 'a gallery is created successfully!');
            return $this->redirectToRoute('adminGallery');
        }
        return $this->render('gallery/admin/create.html.twig', [

            'button' => 'Submit',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/gallery/edit/{id}', name: 'edit_gallery', methods: ['GET', 'POST'])]
    public function adminTourEdit(
        GalleryRepository $tourRepository,
        AuthorizationCheckerInterface $authorizationChecker,
        int $id,
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $gallery = $tourRepository->findOneBy(['id' => $id]);
        $form = $this->createForm(GalleryType::class, $gallery);
        $form->handleRequest($request);

        if (!$authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
            return $this->render('access_denied.html.twig');
        }
        if ($form->isSubmitted() && $form->isValid()) {

            $gallery = $form->getData();

            $manager->persist($gallery);
            $manager->flush();
            // dd($form->getData($product));
            $this->addFlash('success', 'the gallery '.$id.' is edited successfully!');
            return $this->redirectToRoute('adminGallery');
        }
        return $this->render('gallery/admin/edit.html.twig', [

            'button' => 'Submit',
            'form' => $form->createView(),

        ]);
    }

    #[Route('/gallery/delete/{id}', name: 'delete_gallery', methods: ['GET', 'POST'])]
    public function delete(
        GalleryRepository $galleryRepository,
        int $id,
        Request $request,
        EntityManagerInterface $manager,
        Gallery $gallery,
        AuthorizationCheckerInterface $authorizationChecker
    ): Response {
        if (!$authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
            return $this->render('access_denied.html.twig');
        }
        $manager->remove($gallery);
        $manager->flush();

        $this->addFlash('success', 'the gallery has beign deleted successfully!');
        return $this->redirectToRoute('adminGallery');
    }
}
