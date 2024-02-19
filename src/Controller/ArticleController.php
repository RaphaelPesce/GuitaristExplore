<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_article')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'article' => $articleRepository->findBy([], ['created_at' => 'DESC'])
        ]);
    }

    #[Route('/latest-article', name: 'latest_article')]
    public function latestArticle(ArticleRepository $articleRepository): Response
    {
        return $this->render('partials/latest_article.html.twig', [
            'lastArticle' => $articleRepository->findOneBy([], ['created_at' => 'DESC'])
        ]);
    }
}
