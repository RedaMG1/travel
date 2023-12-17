<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        Request $request,
        MailerInterface $mailer,
        EntityManagerInterface $manager
    ): Response {

        $contactDb = new Contact();

        $form = $this->createForm(ContactType::class, $contactDb);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $email = $contact->getEmail();
            $content = $contact->getMessage();
            $subject = " Subjeect test Mailer";
            $contactDb->setSubject($subject);


            $email = (new Email())

                ->from($email)
                ->to('redareada6b@gmail.com')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject($subject)
                ->text($content);
            // ->html('<p>See Twig integration for better HTML integration!</p>');
            $manager->persist($contactDb);
            $manager->flush();
            $mailer->send($email);
            return $this->redirectToRoute('contactThanks');
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form,
        ]);
    }

    #[Route('/contact/sent', name: 'contact_thanks')]
    public function contactThanks(): Response
    {

        return $this->render('contact/thanks.html.twig', []);
    }
}
