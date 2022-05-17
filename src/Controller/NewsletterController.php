<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Repository\NewsletterRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/newsletter")
 */
class NewsletterController extends AbstractController
{

    /**
     * @Route("/", name="app_newsletter")
     * 
     */
    public function index(): Response
    {
        return $this->render('parts/newsletter.html.twig');
    }
    
    /**
     * @Route("/confirmation", name="app_confirm")
     * 
     */
    public function confirm(ArticleRepository $articleRepository): Response
    {
        return $this->render('newsletter/confirm.html.twig', [

            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_newsletter_new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
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

        return $this->renderForm('newsletter/new.html.twig', [
            'newsletter' => $newsletter,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_newsletter_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(Newsletter $newsletter): Response
    {
        return $this->render('newsletter/show.html.twig', [
            'newsletter' => $newsletter,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_newsletter_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Newsletter $newsletter, NewsletterRepository $newsletterRepository): Response
    {
        $form = $this->createForm(Newsletter1Type::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsletterRepository->add($newsletter);
            return $this->redirectToRoute('app_newsletter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('newsletter/edit.html.twig', [
            'newsletter' => $newsletter,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_newsletter_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Newsletter $newsletter, NewsletterRepository $newsletterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsletter->getId(), $request->request->get('_token'))) {
            $newsletterRepository->remove($newsletter);
        }

        return $this->redirectToRoute('app_newsletter_index', [], Response::HTTP_SEE_OTHER);
    }
}
