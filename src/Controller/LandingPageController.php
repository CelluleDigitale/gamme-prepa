<?php

namespace App\Controller;

use App\Form\FormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageController extends AbstractController
{


    private $mailer;

    public function __construct(MailerInterface $mailer)
    {

        $this->mailer = $mailer;
    }
    /**
     * @Route("/", name="landing_page")
     */
    public function index(): Response
    {
        $form = $this->createForm(FormType::class);


        return $this->render('landing_page/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/sendmailer", name="landing_page_mailer")
     */
    public function sendMailer(MailerInterface $mailer, Request $request): Response
    {


        $firstname = $request->get("form")['firstname'];
        $lastname = $request->get("form")['lastname'];
        $emailProspect = $request->get("form")['email'];
        $sites = $request->get("form")['sites'];
        $phone = $request->get("form")['phone'];
        
        if ($sites == "Brest" || $sites == "Pont-de-Buis") {
            $email = 'ibep.brest@yopmail.com';
        } else if ($sites == "Concarneau" || $sites == "Douarnenez" || $sites == "Pont-l\'Abbé") {
            $email = 'ibep.quimper@yopmail.com';
        } else {
            $email = 'ibep.lorient@yopmail.com';
        }
        // On génère l'e-mail
   
        $message = (new TemplatedEmail())
        ->from('plateforme@ibepformation.fr')
        ->to($email)
        ->subject("[PREPA PROJET] - Demande de contact par " . $firstname . ' ' . $lastname)
        ->htmlTemplate('landing_page/signup.html.twig')
        ->context([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'emailUser' => $emailProspect,
            'site' => $sites,
            'phone' => $phone,
        ]);

    // On envoie l'e-mail
    $this->mailer->send($message);
       
        // On redirige vers la page de login
        return $this->redirectToRoute('landing_page');
    }
}
