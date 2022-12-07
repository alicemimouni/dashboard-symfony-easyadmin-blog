<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;




class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(ArticleRepository $articleRepository, Request $request): Response
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

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'articles' => $articleRepository->findAll()
        ]);

    }

    // NAVBAR
    // ######
     /**
     * @Route("/menu", name="category_menu", methods={"GET"})
     * 
     */
    public function menuCategories(CategoryRepository $categoryRepository): Response
    {
        return $this->render('parts/header.html.twig', [
            'categories' => $categoryRepository->findAll()
        ]);
    }
    
    // SOCIAL SHARE
    // ######
     /**
     * @Route("/share", name="app_share")
     * 
     */
    public function share(): Response
    {
        return $this->render('parts/social_share.html.twig', [
        ]);
    }

     // ALL ARTICLES ORDER BY CATEGORIES
    // ###################################
    /**
     * @Route("/articles-order-by-categories", name="articles_by_category", methods={"GET"})
     * 
     */
    public function allCategories(CategoryRepository $categoryRepository): Response
    {

        return $this->render('parts/all_categories.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    // ALL ARTICLES FOR ONE CATEGORY
    // #########################
    /**
     * @Route("/categorie/{slug}", name="articles_for_one_category", methods={"GET"})
     * 
     */
    public function findByCategory(ArticleRepository $articleRepository, Category $category, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findBy(['id' => $category]);

        return $this->render('article/articles_by_category.html.twig', [
            'articles' => $articleRepository->findAll(),
            'categories' => $categories,
        ]);
    }


    // DETAIL ONE article
    // ####################
    /**
     * @Route("/post/{slug}", name="detail_article", methods={"GET", "POST"})
     */
    public function getOneArticle(Article $article, ArticleRepository $articleRepository, Request $request): Response
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

        return $this->render('article/detail_article.html.twig', [
            'article' => $article,
            'articles' => $articleRepository->findAll(),
        ]);  
    }
    
}
