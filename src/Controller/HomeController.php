<?php

namespace App\Controller;

use App\Entity\PostArticle;
use App\Repository\PostArticleRepository;
use App\Repository\PostCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param PostCategoryRepository $categoryRepository
     * @return Response
     */
    public function index(PostCategoryRepository $categoryRepository)
    {
        return $this->render('home/index.html.twig', [
            'categories' => $categoryRepository->findAll()
        ]);
    }

    /**
     * @Route("/article/{slug}", name="article")
     * @param PostArticle $article
     * @return Response
     */
    public function article(PostArticle $article) {
        $url = $this->generateUrl('article', [
            'slug' => $article->getSlug()
        ], UrlGeneratorInterface::ABSOLUTE_URL);

        $twitter_params =
            '?text=' . urlencode($article->getTitle()) . '+-' .
            '&amp;url=' . urlencode($url);


        $share_link = "http://twitter.com/share" . $twitter_params . "";

        return $this->render('home/article.html.twig', [
           'article' => $article,
            'share_link' => $share_link
        ]);
    }
}
