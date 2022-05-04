<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_default")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'articles' => $articleRepository->findAll(),
        ]);
    }

    // DETAIL ONE article
    // ####################
    /**
     * @Route("/article-detail/{article}", name="detail_article", methods={"GET"})
     */
    public function getOneArticle(article $article): Response
    {
        return $this->render('article/detail_article.html.twig', [
            'article' => $article,
        ]);
    }
}
