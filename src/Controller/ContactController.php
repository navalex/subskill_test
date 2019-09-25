<?php

namespace App\Controller;

use App\Form\ContactType;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @param TranslatorInterface $translator
     * @return Response
     */
    public function index(Request $request, Swift_Mailer $mailer, TranslatorInterface $translator)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $message = (new \Swift_Message(''))
                ->setFrom($data['from'])
                ->setTo('alexnava@hotmail.fr')
                ->setSubject($data['subject'])
                ->setBody(
                    "${data['civility']} ${data['first_name']} ${data['last_name']}\n${data['content']}",
                    'text/plain'
                )
            ;
            $mailer->send($message);
            $this->addFlash('success', $translator->trans('contact.success'));
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
