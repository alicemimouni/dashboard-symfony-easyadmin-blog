<?php

use Symfony\Component\HttpFoundation\Session\SessionInterface;

namespace App\Services;

use Symfony\Component\HttpFoundation\Session\SessionInterface;


class NewsletterService {

    public function subscribe(): Response
    {
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsletter);
            $entityManager->flush();

            return $this->redirectToRoute('app_confirm', [], Response::HTTP_SEE_OTHER);
        }
}

}