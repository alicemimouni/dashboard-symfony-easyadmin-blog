<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;


class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'articles' => $articleRepository->findAll(),
        ]);
    }

    // NAVBAR
    // ######
     /**
     * @Route("/menu", name="category_menu", methods={"GET"})
     * 
     */
    public function menuCategories(ArticleRepository $articleRepository): Response
    {
        return $this->render('parts/header.html.twig', [
            'articles' => $articleRepository->findAll()
        ]);
    }

    // DETAIL ONE article
    // ####################
    /**
     * @Route("/article-blog/{slug}", name="detail_article", methods={"GET"})
     */
    public function getOneArticle(Article $article, ArticleRepository $articleRepository): Response
    {
        return $this->render('article/detail_article.html.twig', [
            'article' => $article,
            'articles' => $articleRepository->findAll(),
        ]);
    }

     // ALL PRODUCTS BY CATEGORY
    // #########################
    /**
     * @Route("/articles-{slug}", name="articles_by_category", methods={"GET"})
     * 
     */
    public function findByCategory(Category $category, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findBy(['id' => $category]);

        return $this->render('article/articles_by_category.html.twig', [
            'categories' => $categories,
        ]);


    } 

}
