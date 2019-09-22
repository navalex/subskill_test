<?php

namespace App\Controller;

use App\Entity\PostCategory;
use App\Repository\PostArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post-api/articles/{offset}/{category_id}", name="post")
     * @param PostArticleRepository $articleRepository
     * @param $offset
     * @return Response
     */
    public function index(PostArticleRepository $articleRepository, $offset, $category_id = null)
    {
        $articles = $articleRepository->offsetLimitFind($offset, 10, $category_id);

        if (!$articles) {
            throw $this->createNotFoundException();
        }
        return $this->render('post/post_list.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove")
     * @param PostCategory $category
     * @param EntityManagerInterface $em
     */
    public function removeCat(PostCategory $category, EntityManagerInterface $em)
    {
        $em->remove($category);
    }
}
