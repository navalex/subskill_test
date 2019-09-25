<?php

namespace App\Controller;

use App\Entity\PostArticle;
use App\Form\PostArticleType;
use App\Repository\PostArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/article")
 */
class PostArticleController extends AbstractController
{
    /**
     * @Route("/crud-list", name="post_article_index", methods={"GET"})
     */
    public function index(PostArticleRepository $postArticleRepository): Response
    {
        return $this->render('post_article/index.html.twig', [
            'post_articles' => $postArticleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="post_article_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $postArticle = new PostArticle();
        $form = $this->createForm(PostArticleType::class, $postArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($postArticle);
            $entityManager->flush();

            return $this->redirectToRoute('post_article_index');
        }

        return $this->render('post_article/new.html.twig', [
            'post_article' => $postArticle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="post_article_show", methods={"GET"})
     */
    public function show(PostArticle $postArticle): Response
    {
        $url = $this->generateUrl('post_article_show', [
            'slug' => $postArticle->getSlug()
        ], UrlGeneratorInterface::ABSOLUTE_URL);

        $twitter_params =
            '?text=' . urlencode($postArticle->getTitle()) . '+-' .
            '&amp;url=' . urlencode($url);

        $share_link = "http://twitter.com/share" . $twitter_params . "";
        return $this->render('post_article/show.html.twig', [
            'post_article' => $postArticle,
            'share_link' => $share_link
        ]);
    }

    /**
     * @Route("/{id}/edit", name="post_article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PostArticle $postArticle): Response
    {
        $form = $this->createForm(PostArticleType::class, $postArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_article_index');
        }

        return $this->render('post_article/edit.html.twig', [
            'post_article' => $postArticle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="post_article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PostArticle $postArticle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postArticle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($postArticle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_article_index');
    }

    /**
     * @Route("/ajax/{offset}/{category_id}", name="post_article_fetch_array")
     * @param PostArticleRepository $articleRepository
     * @param $offset
     * @param null $category_id
     * @return Response
     */
    public function fetchAjax(PostArticleRepository $articleRepository, $offset = 0, $category_id = null)
    {
        $articles = $articleRepository->offsetLimitFind($offset, 10, $category_id);

        if (!$articles) {
            throw $this->createNotFoundException();
        }
        return $this->render('post_article/post_list.html.twig', [
            'articles' => $articles
        ]);
    }
}
