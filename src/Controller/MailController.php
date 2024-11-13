<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    #[Route('/email', name: 'app_mail')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('e.raffalli@hotmail.fr')
            ->to('mimiliadu94@hotmail.fr')
            ->subject('Test mail!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        try {
            $mailer->send($email);
            return $this->redirectToRoute('app_success');
        } catch (TransportExceptionInterface $e) {
            // En cas d'erreur, capture l'exception et affiche le message
            return new Response('Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
        }
    }
}


