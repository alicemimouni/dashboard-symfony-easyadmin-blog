<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SearchType;

class SearchController extends AbstractController
{
    /**
     * @Route("/recherche", name="app_search")
     */
    public function search(ArticleRepository $articleRepository, Request $request): Response
    {
        $form =  $this->createForm(SearchType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $filtres = $form->getData();
            $articles = $articleRepository->search($filtres);
        }
        else {
            // $articles = $articleRepository->findAll();
            $articles = [];
        }
        //return all articles
        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'articles' => $articles
        ]);
    }
}
