<?php

namespace App\Controller;

use App\Entity\Article;
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
     * @Route("/article-blog/{slug}", name="detail_article", methods={"GET"})
     */
    public function getOneArticle(Article $article): Response
    {
        return $this->render('article/detail_article.html.twig', [
            'article' => $article,
        ]);
    }
}
