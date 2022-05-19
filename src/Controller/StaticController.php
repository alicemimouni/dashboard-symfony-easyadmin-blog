<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController
{
    /**
     * @Route("/mentions-legales", name="app_mentions")
     */
    public function index(): Response
    {
        return $this->render('static/mentions-legales.html.twig', [
            'controller_name' => 'StaticController',
        ]);
    }
}
